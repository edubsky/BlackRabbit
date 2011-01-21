<?php
/**
 * Message Component
 * A simple component used to handle messaging accross actions
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.message
 */
class MessageComponent extends Object{
  var $name= 'Message';
  var $controllerVar = 'flashMessages'; // key used to store messages in controller/view data
  var $sessionKey = 'Messages';         // key used to store message in sessions
  var $Controller;                      // controller shortcut
  var $Session;                         // session component shortcut
  var $messages;                        // message queue
  var $autoRedirect = false;

 /**
  * Initialize
  * @param object $controller Controller using this component
  * @return boolean Proceed with component usage (true), or fail (false)
  */
  function initialize(&$controller,$settings=array()){
    $this->Controller = &$controller;
    if (isset($this->Controller->Session)) {
      $this->Session = &$controller->Session;
      if($this->Session->check($this->sessionKey)){
        $this->messages = $this->Session->read($this->sessionKey);
        $this->Session->delete($this->sessionKey);
      } else {
        $this->messages = array();
      }
      return true;
   } else {
      $this->add(__('Session component not found  (Message::initilize)',true),'fatal');
    }
  }

  /**
   * Add an error message in the message queue
   * @param string $code error code
   * @param string $message
   * @param mixed $redirect url, string or array
   * @param boolean $fatal
   * @return void
   * @access public
   */
  function error($code, $message, $redirect=null, $fatal=false){
    $type = $fatal ? 'fatal' : 'error';
    $this->add($type,$message,$redirect,$code);
  }

  /**
   * Add a warning messsage to the queue
   * @param string $message
   * @param mixed $redirect url, string or array
   */
  function warning($message,$redirect=null,$code=null) {
    $this->add('warning',$message,$redirect,$code);
  }

  /**
   * Add a notice message to the queue
   * @param string $message
   * @param mixed $redirect url, string or array
   */
  function notice($message, $redirect=null) {
    $this->add('notice',$message,$redirect);
  }

  /**
   * Add a notice message to the queue
   * @param string $message
   * @param mixed $redirect url, string or array
   */
  function success($message, $redirect=null) {
    $this->add('success',$message,$redirect);
  }

  /**
   * Add a message to the queue
   * @param mixed $message
   * @param string $type {error, notice, etc.}
   * @param mixed $redirect array, or string, or bollean
   * @param bollean die
   * @access private
   */
  function add($type='error', $message=null, $redirect=null, $code=null){
    $die = false;
    $title = '';
    $type = strtolower($type);
    switch($type) {
      // For translation & to look good on tv...
      case 'fatal' :
        $die = true;
        $title = __('Fatal',true);
        $this->Controller->Log->error = true;
      break;
      case 'error' :
        $this->Controller->Log->error = true;
        $title = __('Error',true);
      break;
      case 'success':
      case 'notice' : $title = __('Notice',true); break;
      case 'warning': $title = __('Warning',true); break;
      case 'debug'  : $title = __('Debug',true); break;
    }

    $this->messages[] = array(
      'id' => Common::uuid(),
      'type' => ((empty($code)) ? $type : $type.' '.$code ),
      'title' => $title,
      'text' => $message
    );

    // Get the point or die trying
    if($die){
      echo $title.': '.$message;
      exit;
    }

    // Need some directions?
    if(!empty($redirect) || (is_bool($redirect) && $redirect) || $this->autoRedirect){
      if(!is_string($redirect) && !is_array($redirect)) {
        $redirect = $this->Controller->referer();
      }
      $this->Controller->redirect($redirect);
      exit;
    }
  }

  /**
   * Before redirect callback
   * @param object $controller
   * @param mixed $url
   * @param string $status
   * @param bool $exit
   * @return void
   */
  function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
    // save pending messages in session to display next
    if(isset($this->messages) && !empty($this->messages)){
      $this->Session->write($this->sessionKey, $this->messages);
    }
  }

  /**
   * Before render callback
   * @param object $controller
   * @return void
   */
  function beforeRender(&$controller) {
    $this->Controller->set($this->controllerVar, $this->messages);
  }

}//_EOF
