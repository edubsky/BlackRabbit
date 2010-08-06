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
  var $actsAs = array(
    'SavedBy'
  );

  var $belongsTo = array(
    'Person',
    'Office',
    'Role'
  );
  
  var $hasOne = array(
  //  'Role'
  );
  
  var $hasMany = array(
   // 'AuthKey' => array('dependent' => true),
   // 'ReportsUser' => array('dependent' => true)
  );

  /**
   * Validation rules
   * @var $validate array
   */
  var $validate = array(
    'name' => array(
      'required' => array(
        'rule' => 'notEmpty', 
      )
    ),
    'login' => array(
      'valid' => array(
        'rule' => 'email'
      )
      // , 'unique' => array(
      //   'rule' => 'validateUnique',
      //   'field' => 'login', 'message' =>
      //   'This email is already used by another account.'
      // )
    )
    , 'password' => array(
      'required' => array(
        'rule' => array('minLength', 8)
      )
      , 'confirmed' => array(
        'rule' => 'validateConfirmed',
        'confirm' => 'repeat_password'
      )
    )
  );
  
  /**
   * Return information about the user
   * @param $field array desired field(s)
   * @return $user array field or entire user record if field is unspecified
   */
  static function get($field=null){
    // Get the User object from current instance or session
    $user = Configure::read('User');

    if (empty($user) && !defined('INTERNAL_CAKE_ERROR')) {
      $Session = Common::getComponent('Session');
      $user = $Session->read('User', $user);
    }

    if (empty($field) || is_null($user)) {
      return $user;
    }

    if (strpos($field, '.') === false) {
      if (in_array($field, array_keys($user))) {
        return $user[$field];
      }
      $field = 'User.'.$field;
    }

    return Set::extract($user, $field);
  }
  
  /**
   * Is the user session active?
   * @return boolean
   */
  static function isActive() {
    return (is_null(User::get()));
  }
  
  /**
   * Is the user a Guest ?
   * @return boolean
   */
  static function isGuest() {
    return (low(User::get('Role.name')) == low(__('Guest',true)));
  }
  
  /**
   * Set the user as current
   * @param array $user
   * @param bool $updateSession
   * @param bool $generateAuthCookie
   */
  static function setActive($user = null, $updateSession = false, $generateAuthCookie = false) {
    $_this = ClassRegistry::init('User');

    if (isset($user['User']['id']) && Common::isUuid($user['User']['id'])) {
      $user = $_this->find('first',$_this->__getCurrentUserFindConditions($user['User']['id']));
    } else {
      $user = $_this->find('first',$_this->__getGuestUserFindConditions());
    }

    Assert::true(Common::isUuid($user['User']['id']), '500');
    Configure::write('User', $user);
    Assert::identical(Configure::read('User'), $user);

    $Session = Common::getComponent('Session');
    Assert::true($Session->write('User', $user));

    if ($generateAuthCookie) {
      $Cookie = Common::getComponent('Cookie');
      $Cookie->write('Auth.name', $user['User']['login'], false, Configure::read('App.Cookie.Life'));
    }
  }

  /**
   * Return the conditions for finding the current user
   * Used to defined which related models' information are to be retrieved 
   * @param $id User.id
   * @return $conditions array 
   */
  static function __getCurrentUserFindConditions($id){
    return array(
        'conditions' => array(
          'User.id' => $id,
          'User.active' => 1
        ),
        'contain' => array(
          'Person','Role', 'Office'
        ),
        'fields' => array(
          'User.id', 'User.username', 'User.permissions',
          'User.locale', 'User.language', 'User.active', 
          'User.person_id', 'Person.fname', 'Person.lname',
          'User.role_id', 'Role.permissions', 'Role.name',
          'User.office_id', 'Office.name', 'Office.acronym', 'Office.region', 'Office.type' 
        )
      );
  }
  
  static function __getGuestUserFindConditions(){
    return array(
      'conditions' => array(
        'User.username' => 'guest',
        'User.active' => 1
      ),
      'contain' => array(
        'Role'
      ),
      'fields' => array(
        'User.id', 'User.username', 'User.permissions',
        'User.locale', 'User.language', 'User.active', 
        'User.role_id', 'Role.permissions', 'Role.name'
      )
    );
  }
  
  /**
   * Is a user allowed to do something?
   * @param array $ressource
   * @param array $property
   * @param string $rules - something like "*:*,!projects:delete"
   */
  static function isAllowed($ressource, $property){
    return (Common::RoleVsUserRights(
      Common::requestAllowed($ressource, $property, User::get('Role.permissions')), 
      Common::requestAllowed($ressource, $property, User::get('User.permissions'))
    ));
  }
}
?>