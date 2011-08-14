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
  var $whitelist;
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
    // requires Message component
    if (isset($this->Controller->Message)) {
      $this->Message = &$this->Controller->Message;
    } else {
      throw new exception(
        'Authentication Component requires Message Component'
      );
    }
    $this->whitelist = Configure::read('App.auth.whitelist');
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
    if (!in_array($this->Controller->action, $this->whitelist)) {
      return User::isAuthorized(
        $this->Controller->name,
        $this->Controller->action
      );
    }
    return true;
  }

  /**
   * Check the access to controller:actions
   * @return void
   * @access public
   */
  function checkAccess() {
    if (!$this->isAuthorized()) {
      $this->Controller->Log->authorized = false;
      $this->Controller->Log->log();
      if (!User::isGuest()) {
        // display a more explicit error if user is logged in
        $msg = sprintf(__('Sorry you are not allowed to access this resource (%s:%s).',true),
          $this->Controller->name, $this->Controller->action);
        $this->Message->error(
          'ERROR_ACCESS_DENIED', $msg, true
        );
      } else {
        // TODO save requested url in session for further use
        // if the user is not logged in, display a vague error msg
        // unless the user is asking for '/' then redirect to login
        if ($this->Controller->here != $this->Controller->webroot) {
          $msg = __('Sorry you are not allowed to access this resource.',true);
          $this->Message->error(
            'ERROR_ACCESS_DENIED', $msg, '/login'
          );
        } else {
          $this->Controller->redirect('/login');
        }
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
    // check if user already logged in
    if (!User::isGuest()) {
      $this->Message->warning(
        'WARNING_ALREADY_LOGIN',
        __('You are already logged in!',true)
      );
      $success = true; // still a success
      return $success;
    }

    // identification via some post data
    if (isset($this->Controller->data['User'])) {
      // hide password with hash
      $this->__hashPasswords(&$this->Controller->data);
      // validate login field
      $user = $this->__validateInputAndGetUser(
        'login', &$this->Controller->data
      );
      // if creditials are invalid notify
      // if user account is disabled notify
      // if user exist, set it as the current one
      if (empty($user)) {
        $this->Message->error(
          'ERROR_INVALID_CREDENTIALS',
          __('Sorry, the credentials you provided are invalid.',true)
        );
      } elseif(!$user['User']['active']) {
        $this->Message->error(
          'ERROR_ACCOUNT_DISABLED',
          __('Sorry, your account have been disabled. Please contact your administrator.',true)
        );
      } else {
        $user = User::setActive($user,false);
        $success = true;
      }
      // do not display validation errors
      unset($this->User->validationErrors);
    }
    //TODO identify with cookies
    //TODO identify with url token
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
    $this->Controller->redirect('/login');
    exit;
  }

  /**
   * Forgotten password procedure
   * Uses the one time authentication key mechanism
   * @TODO finish lost password procedure
   * @return void
   * @access public
   */
  function forgotPassword() {
    // only apply when the user is not logged in
    if (!User::isGuest()) {
      $this->Controller->redirect('/password/reset');
    } elseif (!empty($this->Controller->data)) {
      // Validate input and get the user if any
      $user = $this->__validateInputAndGetUser(
        'forgotPassword', $this->Controller->data
      );
      if (!empty($user)) {
        // Only send an auth key to active users
        if (!$user['User']['active']) {
          // notify the user if account is disabled
          $this->Message->error(
            'ERROR_ACCOUNT_DISABLED',
            __('Your account have been disabled. Please contact our support.',true)
          );
        } else {
          // generate a recovery token from the auth key
          $user['User']['key'] = $this->__generateAuthToken($user['User']['id']);
          // sent recovery token by email and notify the user
          $this->__sendResetPasswordToken(&$user,'email');
          $this->Message->notice(
            __('An email was sent with the instructions to reset your password!', true)
          );
        }
      } else {
        // user doesn't exit or invalidate
        $this->Message->error(
          'ERROR_INVALID_EMAIL',
          __('This is not a valid email address', true)
        );
      }
    }
    // do not display validation errors
    unset($this->User->validationErrors);
  }

  /**
   * Reset Password Procedure from Token
   * @param string64 $token
   * @return void
   * @access public
   */
  function resetPassword($token=null) {
    if (User::isGuest()) {
      // check if the auth key is valid
      $authKey = $this->__validateAuthToken($token);
      if (!empty($authKey)) {
        // if no data was submited check if things are ok
        if (empty($this->Controller->data)) {
          $data['User']['id'] = $authKey['AuthKey']['user_id'];
          $user = $this->__validateInputAndGetUser('resetPasswordLoad', $data);
          // notify if the user doesn't exist
          // notify if the user is not active
          if (empty($user)) {
            $this->Message->error(
              'PASSWD_RESET_TOKEN_USER',
              __('Sorry, the password reset token you provided is invalid.',true)
            );
          } elseif (!$user['User']['active']) {
            $this->Message->error(
              'ERROR_ACCOUNT_DISABLED',
              __('Your account have been disabled. Please contact our support',true)
            );
          }
        } else {
          // if new password is submited validate and save
          $this->User = (isset($this->Controller->User)) ?
            $this->Controller->User : Common::getModel('User');
          $this->User->data = $this->Controller->data;
          $rules = $this->User->getValidationRules('resetPasswordSave');
          if ($this->User->validates($rules)) {
            // hide password with hash
            $this->__hashPasswords(&$this->User->data);
            $this->User->id = $authKey['AuthKey']['user_id'];
            $saved = $this->User->save($this->User->data, array(
              'validate' => false,
              'fieldList' => $rules['fieldlist']
            ));
            if ($saved) {
              // destroy the auth key
              $saved = $this->User->AuthKey->delete($authKey['AuthKey']['id']);
              if($saved && Configure::read('debug')) {
                $this->Message->success(
                  __('The authentication token have been deleted.', true)
                );
              } elseif(Configure::read('debug')) {
                $this->Message->error(
                  'ERROR_AUTHKEY_DELETE',
                  __('Oops, an internal error occured and the authentication token could not be deleted.',true)
                );
              }
              // redirect user to login
              $this->Message->success(
                __('The password was sucessfully saved', true),
                '/login'
              );
            } else {
              // couldn't save
              $this->Message->error(
                'ERROR_PASSWORD_EDIT_SAVE',
                __('Oops, an internal error occured and the password could not be saved, please try again later.',true)
              );
            }
          } else {
            // validation failed
            $this->Message->error(
              'ERROR_PASSWORD_EDIT_VALIDATION',
              __('The password provided is invalid, please correct the errors bellow.',true)
            );
          }
        }
      }
    } else {
      echo 'TODO not guest'; die;
    }
  }

  /**
   * Send instructions for forgotten password
   * @param  array $user
   * @return bollean $success
   * @access private
   */
  function __sendResetPasswordToken(&$user, $channel='email') {
    $this->Controller->set('user',$user);
    $this->Controller->Mailer->subject = Configure::read('App.email.subjectPrefix').
      __('Please reset your password',true);
    $this->Controller->Mailer->template = 'forgot_password';
    $this->Controller->Mailer->send();
  }

  /**
   * Generate Hash for Passwords
   * @param mixed $data submitted data
   * @return mixed $data with hashed password
   * @access private
   */
  function __hashPasswords($data) {
    if (isset($data['User']['password']) && !empty($data['User']['password'])) {
      $data['User']['password'] = Security::hash($data['User']['password']);
    }
    return $data;
  }

  /**
   * Generate Auth Token
   * @param uuid $userid
   * @param enum(forgot_password,cookie) AuthKey type
   * @access private
   */
  function __generateAuthToken($userid,$type='reset') {
    $key = $this->__generateAuthKey($userid, $type);
    $token = str_replace('-','',
      $key['AuthKey']['user_id'].$key['AuthKey']['id']
    );
    return $token;
  }

  /**
   * Generate an authentication key
   * @param uuid userid
   * @param string type of key {reset,cookie,etc.}
   * @return array $AuthKey or null if it didn't work out
   * @access private
   */
  function __generateAuthKey($userid, $type='reset') {
    if(array_key_exists($type,Configure::read('App.auth.keys'))) {
      if (!isset($this->AuthKey) || empty($this->AuthKey)) {
        $this->AuthKey = Common::getModel('AuthKey');
      }
      // delete other authentication keys
      $this->AuthKey->deleteAll(
        array('user_id' => $userid), false
      );
      // calculate expiry date for the key
      // ex. of config: '+3 days'
      $expire = date(
        'Y-m-d H:i:s',
        strtotime(Configure::read('App.auth.keys.'.$type.'.expire'))
      );
      // insert the new key in the DB
      $this->AuthKey->data = $data = array(
        'AuthKey' => array(
          'id' => String::uuid(),
          'user_id' => $userid,
          'type' => $type,
          'expire' => $expire
        )
      );
      if ($this->AuthKey->save()) {
        return $data;
      } else {
        //TODO raise exception couldn't save
        //echo 'could not save'; die;
      }
    } else {
      //TODO raise exception bad auth key type
      //echo 'bad auth key type';die;
    }
    return null;
  }

  /**
   * Validate Authentication Token
   * @param char64 authentication key id + user id
   * @return array authKey
   */
  function __validateAuthToken($token=null) {
    if (empty($token) || !preg_match('/^([A-Fa-f0-9]{64})$/',$token)) {
      $this->Message->error(
        'ERROR_PASSWORD_RESET_TOKEN_FORMAT',
        __('Sorry, the password reset token you provided is invalid.',true),
        '/login'
      );
    } else {
      if (!isset($this->AuthKey) || empty($this->AuthKey)) {
        $this->AuthKey = Common::getModel('AuthKey');
      }
      $this->AuthKey->data = $this->__extractAuthKeyFromToken($token);
      $key = $this->AuthKey->find('first');
      if (!empty($key)) {
        if (strtotime($key['AuthKey']['expire']) < strtotime('now')) {
          $this->Message->error(
            'ERROR_PASSWORD_RESET_AUTHKEY_EXPIRED',
            __('Sorry, the password reset token you provided have expired.',true),
           '/login'
          );
        }
      } else {
        $this->Message->error(
          'ERROR_PASSSWORD_RESET_TOKEN_INVALID',
          __('Sorry, the password reset token you provided is invalid.',true),
          '/login'
        );
      }
      return($key);
    }
  }

  /**
   * Return a authentication key object from a token
   * @param string64 token
   * @return array AuthKey
   */
  function __extractAuthKeyFromToken($token) {
    $regex = '/^([A-Fa-f0-9]{8})([A-Fa-f0-9]{4})([A-Fa-f0-9]{4})([A-Fa-f0-9]{4})([A-Fa-f0-9]{12})$/';
    $repex = '$1-$2-$3-$4-$5';
    $data['AuthKey']['user_id'] = preg_replace($regex,$repex,substr($token,0,32));
    $data['AuthKey']['id'] = preg_replace($regex,$repex,substr($token,32,32));
    return $data;
  }

  /**
   * Validate auth related data and return a user if any
   * @param string $context such as login, reset password, ect.
   * @param array $data from the form
   * @return array $user
   * @access private
   */
  function __validateInputAndGetUser($context, $data) {
    $user = null;
    $this->User = Common::getModel('User');
    // validate the input data
    $this->User->data = $data;
    $rules = $this->User->getValidationRules($context);
    if (empty($rules) || $this->User->validates($rules)) {
      // build search conditions
      $options = User::getFindOptions($context, $data);
      // find a user or die trying
      $user = $this->User->find('first', $options);
    }
    return $user;
  }
}//_EOF
