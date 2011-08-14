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
   * Login action
   * @return void
   * @access public
   */
  function login() {
    if ($this->Auth->login()) {
      $this->redirect('/home');
    } else {
      // check if application cookie is set or display warning
      // see also js/cookiecheck.js
      Common::isCookieSet();
      $this->layout = 'login';
    }
  }

  /**
   * Logout action
   * @return void
   * @access public
   */
  function logout() {
    $this->Auth->logout();
  }

  /**
   * Forgotten password procedure
   * @return void
   * @access public
   */
  function forgot_password() {
   $this->layout = 'login';
   $this->Auth->forgotPassword();
  }

  /**
   * Reset a password
   * @param string[32+32] user_id + authKey uuid without '-' inverted
   * @return void
   * @access public
   */
  function reset_password($token=null) {
    if (User::isGuest()) {
      $this->layout = 'login';
      $this->Auth->resetPassword($token);
      $this->set('token',$token);
    }
  }

  function index($type=null) {
    /*switch($type){
      case 'archived':
        $conditions = array('archived' =>'1');
      break;
      case 'all': default:
        $conditions = array('archived'=>'0');
      break;
    }
    $this->paginate = array(
      'conditions' => $conditions,
      'contain' => array(
        'Favorite(id,user_id,model,created)',
      ),
      'fields' => array(
        'id','name','description','created'
      )
    );
    $this->set('projects', $this->paginate());

    // view mode
    $viewMode = $this->DisplaySettings->getViewMode();
    if($viewMode) {
      $this->render('index_'.$viewMode);
    }*/

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
