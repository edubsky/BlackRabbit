<?php
/**
 * Authentication Component
 * Used for login, logout, checking rights, etc.
 * Dependencies: User & AuthKey models, message component
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.auth
 */
App::import('Core','Security');
App::import('Model','AuthKey');
class AuthComponent extends Object {
  var $name = 'Auth';
  var $Controller;
  var $whiteList = array('login', 'logout','forgot_password'); // list of authorized actions without auth
  var $loginURL = '/login';   // url used for login
  var $AuthKey; // auth key model instance if needed
  var $User; // user model instance if needed

 /**
  * Initialize
  * @param object $controller Controller using this component
  * @return boolean Proceed with component usage (true), or fail (false)
  * @access public
  */
  function initialize(&$controller,$settings=array()) {
    // setup some shortcuts
    $this->Controller = &$controller;
    // Hide password with hash asap
    $this->hashPasswords(&$this->Controller->data);
  }

  /**
   * Before render callback
   * @return void
   * @access public
   */
  function beforeRender() {
    // Clean up the password hash if any
    if (isset($this->Controller->data['User']['password'])) {
      unset($this->Controller->data['User']['password']);
    }
  }

  /**
   * Authorization checking callback
   * @return boolean, true if action is allowed
   */
  function isAuthorized() {
    if (!in_array($this->Controller->action,$this->whiteList)) {
      return User::isAuthorized(
        $this->Controller->name,
        $this->Controller->action
      );
    }
    return true;
  }

  /**
   * Filter the access to controller:actions
   * @return void
   * @access public
   */
  function filterAccess() {
    if (!$this->isAuthorized()) {
      $this->Controller->Log->authorized = false;
      $this->Controller->Log->log();
      if (User::isGuest()) {
        $this->Controller->Message->add(
          sprintf(__('Sorry you are not allowed to access this resource (%s:%s)',true),
          $this->Controller->name, $this->Controller->action), 'error', $this->loginURL
        );
      } else {
        $this->Controller->Message->add(
          sprintf(__('Sorry you are not allowed to access this resource (%s:%$)'),
          $this->Controller->name, $this->Controller->action), 'error', true
        );
      }
    }
  }

  /**
   * Check if user exist and activate it
   * @return boolean $success
   * @access public
   */
  function login(){
    $success = false;
    if (User::isGuest()) {
       if (!isset($_COOKIE[Configure::read('Session.cookie')])) {
         $this->Controller->Message->warning(
           __('Cookies must be enabled past this point.',true), null, 
          'cookies_must_be_enabled'
         );
       }
      // identify with some post data
      if (isset($this->Controller->data['User'])) {
        // get a proper user model
        $this->User = ClassRegistry::getObject('User');
        // build search conditions
        // including what could be needed next (like preferences)
        $options = User::getFindOptions('login',$this->Controller->data);
        $options = array_merge_recursive(
          $options, User::getFindFields('userActivation')
        );
        $user = $this->User->find('first', $options);
        // if creditials are invalid notify
        // if user account is disabled notify
        // if user exist, set it as the current one
        if (empty($user)) {
          $this->Controller->Message->error(
            'ERROR_INVALID_CREDENTIALS',
            __('Sorry, the credentials you provided are invalid.',true)
          );
        } elseif(!$user['User']['active']) {
          $this->Controller->Message->error(
            'ERROR_ACCOUNT_DISABLED',
            __('Sorry, your account have been disabled.',true)
          );
        } else {
          unset($user['User']['password']); // just to make sure
          $user = User::setActive($user,false);
          $success = true;
        }
      } else {
        // TODO
      }
    } else {
     // user already logged in
     // do nothing
    }
    return $success;
  }

  /**
   * Logout,
   * Clean up and redirect to login screen
   * @return void
   * @access public
   */
  function logout() {
    $this->Controller->Session->destroy();
    $this->Controller->redirect($this->loginURL);
    exit;
  }

  /**
   * Generate Hash for Passwords
   * @param mixed $data submitted data
   * @return mixed $data with hashed password
   * @access public
   */
  function hashPasswords($data) {
    if (isset($data['User']['password']) && !empty($data['User']['password'])) {
      $data['User']['password'] = Security::hash($data['User']['password']);
    }
    return $data;
  }

  /**
   *
   *
  function generateAuthKey($type) {
    if(in_array($type,Configure::read('App.auth.keys')) {
      $this->AuthKey = ClassRegistry::init('AuthKey');
      $this->AuthKey->Data = array(
        'AuthKey' => array(
         'user_id' => User::get('id');
         'expires' => Configure::read('App.auth.keys.expires');
        )
      );
    }
  }*/
}//_EOF
