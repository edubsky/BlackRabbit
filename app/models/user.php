<?php
/**
 * User Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org / debuggable
 * @package     app.model.user
 */
class User extends AppModel {
  var $displayField = 'name';

  var $belongsTo = array(
    'Person',
    'Office',
    'Role'
  );

  var $hasOne = array(
    'Preference'
  );

  var $hasMany = array(
    'AuthKey' => array(
      'dependent' => true
    ),
    'Address' => array(
      'foreignKey' => 'foreign_key',
      'dependent'=> true
    )
  );

  /**
   * Validation rules
   * @var $validate array
   */
  var $validate = array(
    'username' => array(
      'valid' => array(
        'rule' => 'email'
      )
      // , 'unique' => array(
      //   'rule' => 'validateUnique',
      //   'field' => 'login', 'message' =>
      //   'This email is already used by another account.'
      // )
    ),
/*    'password' => array(
      'required' => array(
        'rule' => array('minLength', 8)
      ),
      'confirmed' => array(
        'rule' => 'validateConfirmed',
        'confirm' => 'repeat_password'
      )
    )*/
  );

  /**
   * Return information about the user
   * @param $field array desired field(s)
   * @return $user array field or entire user record if field is unspecified
   */
  static function get($field = null) {
    // try to get the User object from current
    $user = Configure::read('User');
    // try to get from the session otherwise
    if (empty($user)) {
      $Session = Common::getComponent('Session');
      $user = $Session->read('User', $user);
    }
    // or start a guest session
    if (empty($user)) {
      $user = User::setActive('guest');
    }
    // return the object or the needed field
    if (empty($field)) {
      return $user;
    } else {
      if (strpos($field, '.') === false) {
        if (in_array($field, array_keys($user))) {
          return $user[$field];
        }
        $field = 'User.'.$field;
      }
      return Set::extract($user, $field);
    }
  }

  /**
   * Sessions set alias
   * @param $path string
   * @param $value mixed
   */
  static function setValue($path,$value){
    $user = User::get();
    $user = Set::insert($user,$path,$value);
    User::setActive($user,false);
  }

  /**
   * Is the user session active?
   * @return boolean
   */
  static function isActive() {
    return (!is_null(User::get()));
  }

  /**
   * Is the user a Guest ?
   * @return boolean
   */
  static function isGuest() {
    return (strtolower(User::get('Role.name')) == strtolower(__('Guest',true)));
  }

  /**
   * Set the user as current
   * @param array $user
   * @param bool $updateSession
   * @param bool $generateAuthCookie
   */
  static function setActive($user = null, $find=true) {
    $_this = ClassRegistry::init('User');
    //@todo only find if $user is incomplete compared to conditions
    if($find) {
      if ($user!='guest' && isset($user['User']['id']) && Common::isUuid($user['User']['id'])) {
        $user = $_this->find('first',
          $_this->getFindOptions('userActivation',$user)
        );
      }
      if($user=='guest' || is_null($user) || empty($user)) {
        $user = $_this->find('first',
          $_this->getFindOptions('guestActivation')
        );
      }
    }
    Configure::write('User', $user);
    $Session = Common::getComponent('Session');
    $Session->write('User', $user);
    return $user;
  }

  /**
   * Return the find options to be used
   * @param string context
   * @return array
   */
  static function getFindOptions($case,&$data = null) {
    return array_merge(
      User::getFindConditions($case,&$data),
      User::getFindFields($case)
    );
  }

  /**
   * STATIC - Return the conditions to be used
   * to activate a User
   * @param $context string{guest or id}
   * @param $id User.id
   * @return $condition array
   */
  static function getFindConditions($case="guestActivation",&$data=null){
    switch($case){
      case "login":
        $conditions = array(
         'conditions' => array(
           'User.password' => $data['User']['password'],
           'User.username' => $data['User']['username'],
         )
       );
      break;
      case "forgot_password":
        $conditions = array(
         'conditions' => array(
           'User.username' => $data['User']['username'],
         )
        );
      break;
      case "userActivation":
        $conditions = array(
          'conditions' => array(
            'User.id' => $data['User']['id'],
            'User.active' => 1,
          )
        );
      break;
      case "guestActivation": default:
        $conditions = array(
          'conditions' => array(
            'User.username' => 'guest',
          )
        );
      break;
    }
    return $conditions;
  }

  /**
   * STATIC - Return the conditions to be used
   * to activate a User
   * @param string $case context ex: login, activation
   * @return $condition array
   */
  static function getFindFields($case="guestActivation"){
    switch($case){
      case "login":
        $fields = array(
          'fields' => array(
            'User.active'
          )
        );
      break;
      case "forgot_password":
        $fields = array(
          'contain' => array(
            'Person'
          ),
          'fields' => array(
            'User.id', 'User.username', 'User.permissions', 'User.active',
            'User.person_id', 'Person.firstname', 'Person.lastname'
          )
        );
      break;
      case "guestActivation":
        $fields = array(
          'contain' => array(
            'Role(id,permissions,name)',
            'Preference(*)',
            'Person'
          ),
          'fields' => array(
            'User.id', 'User.username', 'User.permissions',
            'User.locale', 'User.active',
            'User.person_id', 'Person.firstname', 'Person.lastname'
          )
        );
      break;
      case "userActivation":
        $fields = array(
          'contain' => array(
            'Role(id,permissions,name)',
            'Preference(*)',
            'Person'
            //'Office(name,acronym,region,type)',
          ),
          'fields' => array(
            'User.id', 'User.username', 'User.permissions',
            'User.locale', 'User.active',
            'User.person_id', 'Person.firstname', 'Person.lastname'
          )
        );
      break;

    }
    return $fields;
  }

  /**
   * Is a user allowed to do something?
   * @param array $ressource
   * @param array $property
   * @param string $rules - something like "*:*,!users:delete"
   */
  static function isAuthorized($ressource, $property){
    return (Common::RoleVsUserRights(
      Common::requestAllowed($ressource, $property, User::get('Role.permissions')),
      Common::requestAllowed($ressource, $property, User::get('User.permissions'))
    ));
  }

}//_EOF
