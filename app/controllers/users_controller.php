<?php
/**
 * Users Controller
 * Used for login, logout, reset password & general CRUD
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.controllers.users
 */
class UsersController extends AppController {
  var $name = 'Users';
  
  /**
   * Before filter hook
   */
  function beforeFilter(){
    $this->Auth->allow('login','forgot_password');
    parent::beforeFilter();
  }

  /**
   * Login
   */ 
  function login() {
    // code will execute only when autoRedirect is set to false 
    // (see. AppController::beforeFilter).
    $current_user = &$this->Auth->user();
    if (isset($current_user)) {
      User::setActive(&$current_user);
      $this->redirect($this->Auth->redirect());
    }
    User::setActive(); // guest session
    if(empty($this->data)){
      $this->Session->delete('Message.auth');
    }
    $this->layout = 'login';
  }
  
  /**
   * Logout 
   */
  function logout() {
    $url = $this->Auth->logout();
    $this->Session->destroy();
    $this->redirect($url);
  }

  /**
   * Reset password procedure
   * Uses the one time authentication key mechanism
   * @TODO Finish lost password procedure
   */
  function forgot_password(){
    if ($this->Auth->user()) {
      $this->redirect($this->Auth->redirect());
    }
    if(empty($this->data)){
      $this->Session->delete('Message.auth');
    } else {
      $this->User->set($this->data);
      // @todo validate only email
      if($this->User->validates()){
        // @todo Check if user exist
        // @todo Generate auth key
        // @todo Send email
      }
    }
    $this->layout = 'login';
  }

  /**
   * Add a User - Admin/Root only
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
?>