<?php
/**
 * Create or  reset admin account
 * usage: cake/console/cake root username
 *
 */
App::import('Core', 'Controller');
App::import('Component', 'Auth');
App::import('Core','Model');
class UserShell extends Shell {
  var $uses = array('User');
  var $components = array('Auth');

  /**
   * Main function
   *
   * @return void
   * @access public
   */
  function main() {
    $login = isset($this->args[0]) ? $this->args[0] : false;

    if (empty($login)) {
      $this->out('Please indicate a username.');
      exit(1);
    }

    $data = $this->User->find('first', array(
      'conditions' => array('username' => $login),
      'fields' => array('id','username')
    ));

    if(empty($data)) {
     $this->out('Invalid username');
     exit(1);
    }

    $this->Auth = new AuthComponent();
    $data['User']['password'] = $this->in('Password?');
    $data = $this->Auth->hashPasswords($data);
    $data['User']['repeat_password'] = $data['User']['password'];

    // Save
    $this->User->set($data);
    if($this->User->save(null,false)) {
      $this->out('Saved!');
    } else {
      $this->out('Uh oh, something went wrong!');
    }
    exit(1);
  }
}//_EOF
?>
