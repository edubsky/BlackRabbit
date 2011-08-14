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

  /**
   * Relationships
   */
  var $belongsTo = array(
    'Timezone',
    'Language',
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
      'email' => array(
        'rule' => 'email',
      ),
      'length' => array(
        'rule' => array('between', 6, 150)
      ),
      'unique' => array(
        'rule' => 'isUnique',
      )
    ),
    'password' => array(
      'length' => array(
        'rule' => array('between', 5, 50)
      ),
      'confirmed' => array(
        'rule' => array('isConfirmed','User.password_again')
      )
      /* TODO Dictionary check with cracklib
      'cracklib' => array(
        'rule' => array('isNotInDictionary')
      ) */
    )
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
    $_this = Common::getModel('User');
    //@TODO only fetch if $user is incomplete compared to find conditions
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
    if (isset($user['User']['password'])) {
      unset($user['User']['password']); // just to make sure
    }
    Configure::write('User', $user);
    $Session = Common::getComponent('Session');
    $Session->write('User', $user);
    return $user;
  }

  /**
   * STATIC - Return the find options to be used
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
   * STATIC - Return the conditions to be used for a given context
   * for example if you want to activate a User session
   * @param $context string{guest or id}
   * @param $data used in find conditions (such as User.id)
   * @return $condition array
   */
  static function getFindConditions($case='guestActivation',&$data=null) {
    switch($case) {
      case 'login':
        $conditions = array(
         'conditions' => array(
           'User.password' => $data['User']['password'],
           'User.username' => $data['User']['username'],
         )
       );
      break;
      case 'forgotPassword':
        $conditions = array(
         'conditions' => array(
           'User.username' => $data['User']['username'],
         )
        );
      break;
      case 'userActivation':
        $conditions = array(
          'conditions' => array(
            'User.id' => $data['User']['id'],
            'User.active' => 1,
          )
        );
      break;
      case 'guestActivation': default:
        $conditions = array(
          'conditions' => array(
            'User.username' => 'guest',
          )
        );
      break;
      case 'resetPasswordLoad':
        $conditions = array(
          'conditions' => array(
            'User.id' => $data['User']['id']
          )
        );
      break;
      default:
        throw new exception('ERROR: User::GetFindConditions case undefined');
        //$fields = array();
      break;
    }
    return $conditions;
  }

  /**
   * STATIC - Return the list of field to fetch for given context
   * @param string $case context ex: login, activation
   * @return $condition array
   */
  static function getFindFields($case="guestActivation"){
    switch($case){
      case 'login':
      case 'resetPasswordLoad':
      case 'resetPasswordSave':
        $fields = array(
          'fields' => array(
            'User.id', 'User.active'
          )
        );
      break;
      case 'forgotPassword':
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
      case 'guestActivation':
        $fields = array(
          'contain' => array(
            'Role(id,permissions,name)',
            'Preference(*)'
          ),
          'fields' => array(
            'User.id', 'User.username', 'User.permissions',
            'User.active'
          )
        );
      break;
      case 'userActivation':
        $fields = array(
          'contain' => array(
            'Role(id,permissions,name)',
            'Timezone(id,name)',
            'Language(id,name,ISO_639-2-alpha2,ISO_639-2-alpha1)',
            'Preference(*)',
            'Person(id,firstname,lastname)'
            //'Office(name,acronym,region,type)',
          ),
          'fields' => array(
            'User.id', 'User.username', 'User.permissions',
            'User.active'
          )
        );
      break;
      default:
        throw new exception('ERROR: User::GetFindFields case undefined');
      break;
    }
    // get additional data if we could to activate afterwards
    if ($case == 'login' || $case == 'resetPasswordSave') {
      $fields = array_merge_recursive(
        $fields, User::getFindFields('userActivation')
      );
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
    return Common::requestAllowed(
      $ressource, $property,
      User::get('Role.permissions').','.User::get('User.permissions')
    );
  }

  /**
   * Set and return the validation rules for a given context
   * @param string $case
   * @return array $rules, fieldlist
   */
   function getValidationRules($case) {
    switch($case) {
     case 'login':
       $rules = array('fieldList' => array('username','password'));
       unset($this->validate['password']['confirmed']);
     break;
     case 'forgotPassword':
       $rules = array('fieldList' => array('username'));
       unset($this->validate['username']['unique']);
     return $rules;
     case 'resetPasswordSave':
       $rules = array('fieldlist' => array('password'));
     return $rules;
     case 'resetPasswordLoad':
     default:
     return null;
    }
  }
}//_EOF
