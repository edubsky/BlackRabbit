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
  var $sessionKey = 'Messages';    // key used to store message in sessions
  var $Controller;                 // controller shortcut
  var $Session;                    // session component shortcut
  var $messages;                   // message queue
  
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
		$this->Controller->set($this->controllerVar, $this->messages);
        $this->Session->delete($this->sessionKey);
      }else{
        $this->messages = array();
      }
      return true;
   } else {
      echo __('Fatal Error: Session component is required in order to use the Message component.',true); 
      die;
    }
  }

  /**
   * Add a message to the queue
   * @param mixed $message 
   * @param string $type {error, notice, etc.}
   * @param mixed $redirect array, or string, or bollean
   * @param bollean die
   */
  function add($message, $type='error', $redirect=true, $die=false){
    switch($type) { 
      // For translation & to look good on tv...
      case 'error' : $title = __('Error',true); break;
      case 'notice' : $title = __('Notice',true); break;
      case 'warning' : $title = __('Warning',true); break;
    }
    $this->messages[] = array('type' => $type, 'title' => $title, 'text' => $message);
    
    // Get the point or die trying
    if($die){
      pr($this->messages); die;
    }
    
    // Need some directions?
    if(!empty($redirect)){
      if(!is_string($redirect) && !is_array($redirect)) {
        $referer = $this->Controller->referer();
        if( $referer != '/') $redirect = $referer;
        else $redirect = '/';
      }
      $this->Controller->redirect($redirect); die;
    }
  }

  /**
   * Before redirect hook
   * @param $controller
   * @param $url
   * @param $status
   * @param $exit
   */
  function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
    if(isset($this->messages) && !empty($this->messages)){
      $this->Session->write($this->sessionKey, $this->messages);
    }
  }

}//_EOF