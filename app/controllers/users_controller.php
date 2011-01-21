<?php
/**
 * Users Controller
 * Used for login, logout, reset password & general CRUD
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.users
 */
class UsersController extends AppController {
  var $name = 'Users'; /// @var controller name

  /**
   * Login Action
   * @return void
   * @access public
   */
  function login() {
    $this->layout = 'login';
    if(!User::isGuest()) {
      $this->Message->warning(
        sprintf(__('You are already logged in!',true),
        $this->name,$this->action),true
      );
    } elseif($this->Auth->login()) {
      $this->redirect('/home');
    }
  }

  /**
   * Logout
   */
  function logout() {
    $this->Auth->logout();
  }

  /**
   * Reset password procedure
   * Uses the one time authentication key mechanism
   * @TODO finish lost password procedure
   * @return void
   * @access public
   */
  function forgot_password() {
    $this->layout = 'login';
    if(!User::isGuest()) {
      $this->Message->warning(
        sprintf(__('Please logout or go to preferences!',true),
        $this->name,$this->action), true
      );
    } elseif(!empty($this->data)) {
      // @TODO validation on email format
      $user = $this->User->find('first',
        $this->User->getFindOptions('forgot_password',$this->data)
      );
      if(!empty($user)){
        // @todo Generate auth key
        // @todo Send email
        if ($user['User']['active']) {
          $this->__send_forgot_password_email(&$user);
          $this->Message->notice(
            __('An email with instruction to reset your password was sent!', true),
            array('action'=>'forgot_password')
          );
        } else {
          $this->Message->error(
            __('Your account have been disabled. Please contact our support.',true),
            array('action'=>'login')
          );
        }
      }
      $this->Message->error(
        __('This is not a valid email address', true),
        array('action'=>'forgot_password')
      );
    }
  }

  /**
   * Send instructions for forgotten password
   * @param  array $user
   * @return bollean $success
   * @access private
   */
  function __send_forgot_password_email($user){
    $this->set('user',$user);
    $this->Mailer->to = $user['User']['username'];
    $this->Mailer->subject = Configure::read('App.email.subjectPrefix').
      __('Please reset your password',true);
    $this->Mailer->template = 'forgot_password';
    $this->Mailer->send();
  }

  /**
   * Add a User - Admin/Root only
   * @return void
   * @access public
   */
  function admin_add() {
    if ($this->data) {
      if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
        $this->User->create();
        $this->User->save($this->data);
      }
    } else {
      // get role list
    }
  }
}//_EOF
