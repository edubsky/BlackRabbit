<?php
/**
 * Loggable Behavior
 * Allow logging save / update / delete operations
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.behaviors.loggable
 */
class LoggableBehavior extends ModelBehavior {

  /**
   * Contain settings indexed by model name.
   * @var array
   * @access private
   */
  var $__settings = array();

  /**
   * User Log Model
   * @var Model
   * @access private
   */
  var $__UserLog;

  /**
   * Defer save?
   * @var boolean
   * @access private
   */
  var $__deferred;

  /**
   * Initiate behavior for the model using settings.
   *
   * @param object $Model Model using the behaviour
   * @param array $settings Settings to override for model.
   * @access public
   */
  function setup(&$Model, $settings = array()){
    $this->__UserLog = ClassRegistry::init('UserLog');
  }

  /**
   * Before Find callback
   * @param $Model
   * @param $query
   */
  function beforeFind(&$Model, $query = array()) {
    $details = print_r($query, true);
    $this->__log($Model->alias,'find',$details);
  }

  /**
   * Before Delete callback
   * @param $model
   * @param $cascade
   */
  function beforeDelete(&$Model, $cascade = true) {
    $this->__log($Model->alias,'delete',null,$Model->id);
  }

  /**
   * Before Save callback
   * @param $Model
   */
  function beforeSave(&$Model) {
    $action = (Common::isUuid($Model->id)) ? 'update' : 'create';
    $details = print_r($Model->data, true);
    $this->__deferred = true;
    $this->__log($Model->alias, $action, $details, $Model->id);
  }

  /**
   * After Save callback
   * @param $Model
   * @param $created
   */
  function afterSave(&$Model, $created) {
    if($this->__deferred){
      $this->__saveLog();
      $this->__deferred = false;
    }
  }

  /**
   * Log the query if required
   * @param $alias string model alias
   * @param $action string
   * @param $details string
   * @param $foreign_key string (uuid)
   */
  function __log($alias, $action, $details, $foreign_key=null){
    if($this->__isLogRequired($action)) {
      $this->__UserLog->create();
      $this->__UserLog->data = array(
        'user_id' => User::get('id'),
        'resource' => $alias,
        'resource_type' => 'model',
        'action' => $action,
        'foreign_key' => $foreign_key,
        'details' => $this->__isLogDetailsRequired($alias,$action) ? $details : null
      );
      if(!$this->__deferred) {
        $this->__saveLog();
      }
    }
  }

  /**
   * Write the log in the database
   */
  function __saveLog() {
    $this->__UserLog->save($this->__UserLog->data,false);
  }

  /**
   * Is logging this model and action required?
   * @param $alias string
   * @param $action string
   */
  function __isLogRequired($action){
    return (Configure::read('App.logs.models.rules.'.$action) > 0);
  }

  /**
   * Is logging the details of the query required?
   * @param $alias string
   * @param $action string
   */
  function __isLogDetailsRequired($action){
    return (Configure::read('App.logs.models.rules.'.$action) > 1);
  }

}//_EOF
