<?php
/**
 * Actions Helper
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     boost.views.helpers.actions
 */
class ActionsHelper extends Apphelper {
  var $helpers = array('Html');
  var $model;
  
  /**
   * Before Render hook function
   * @see AppHelper::beforeRender
   */
  function beforeRender(){
    if(!isset($this->model)){
      $this->model = ClassRegistry::init('Action'); // initialize model or get it back
    }
  }

  /**
   * Get the actions list (helper to model)
   * @param $options array
   * @return array list of actions
   */
  function get($options=array()){
    $defaults = array(
      'context'    => 'default',
      'controller' => $this->params['controller'],
      'action'     => $this->params['action']
    );
    if (isset($this->params['pass'][0])) {
      $defaults['tab'] = $this->params['pass'][0];
    }
    $options = am($defaults,$options);
    $actions = $this->model->get($options);
    return $actions;
  }
}
?>