<?php
/**
 * Log components
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.log
 */
App::import('Model','UserLog');
class LogComponent extends Object {
  var $error = false;
  var $errorCode;

 /**
  * Initialize
  * @param object $controller Controller using this component
  * @param array $settings
  * @return void
  * @access public
  */
  function initialize(&$controller,$settings=array()){
    $this->Controller = &$controller;
    $this->__UserLog = ClassRegistry::init('UserLog');
    $this->Controller->UserLog = &$this->__UserLog;
  }

  /**
   * Use UserLog model to create a log entry
   * @return void
   * @access public
   */
  function log() {
    $logRules = Configure::read('App.logs.controllers.rules');
     // log if there is matching rule
    foreach ($logRules as $rules => $verbose) {
      $verbose = $this->__getVerbose($verbose);
      if (!$verbose) continue;
      if (Common::requestAllowed($this->Controller->name, $this->Controller->action,$rules)) {
        $this->__UserLog->data =  $this->__getDataForLogs($verbose);
        $this->__UserLog->save($this->__UserLog->data,false);
        // log only once
        break;
      }
    }
  }

  /**
   * Get the parameters given in Url
   * @return string url parameters
   * @access private
   */
  function __getDataForLogs($verbose=1){
    // build the data for the log entry
    $data = array(
      'user_id' => User::get('id'),
      'ip' => $this->Controller->RequestHandler->getClientIP(),
      'resource_type' => 'controller',
      'get_data_url' => implode(DS,$this->Controller->params['pass']),
    );
    // clean up a bit on cakeerror
    if ($this->Controller->name != "CakeError") {
      $data['error'] = $this->error;
      $data['error_id'] = $this->errorCode;
      //$data['errorCode'] = $this->errorCode,
      $data['resource'] = strtolower($this->Controller->name);
      $data['action'] = $this->Controller->action;
    } else {
      $data['error'] = true;
      $data['resource'] = strtolower($this->Controller->params['controller']);
      $data['action'] = $this->Controller->params['action'];
    }
    // Better to remain silent and be thought a fool
    if(!empty($this->Controller->data)) {
      if ($verbose == 2) {
        $data['post_data'] = print_r($this->Controller->data,true);
      } elseif ($verbose == 1) {
        $data['post_data'] = count($this->Controller->data);
      }
    }
    // than to speak out and remove all doubt - MT
    $data['get_data_url'] = implode(DS,$this->Controller->params['pass']);
    $data['get_data_named'] = '';
    foreach ($this->Controller->params['named'] as $key => $value) {
      $data['get_data_named'] .=  $key . ':' . $value . DS;
    }
    return $data;
  }

  /**
   * Define the verbose
   * @param mixed verbose as array or int
   * @return verbose as int
   * @access private
   */
  function __getVerbose($verbose) {
    if (!is_array($verbose)) {
      return $verbose;
    } else {
      if ($this->error) {
        return $verbose['error'];
      } else return $verbose['success'];
    }
  }

}//_EOF
