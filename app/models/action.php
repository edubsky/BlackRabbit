<?php
/**
 * Action Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.model.action
 *
 * This Model is responsible for providing the actions to the site
 * depending on what context/section the user is visiting/requesting
 * & his/her role or user rights.
 */
class Action extends AppModel{
  var $useTable = false; // content is not stored in DB

  /**
   * Get the actions for a given section & role
   * @param $section name
   */
  function get($options=null) {
    $results = array();
    $defaultOptions = array(
      'context' => 'default',
      'action' => '*',
      'controller' => '*',
      'shortName' => false
    );
    // Use tab to refine context on index only, as in users:index:archived
    if($options['action'] == 'index' && !isset($options['tab'])){
      $defaultOptions['tab'] = '*';
    }

    // Override defaults options with given (if any)
    $options = array_merge($defaultOptions,$options);
    // get the action list
    $map = $this->__get($options);

    //format the action with url, class, options
    foreach($map as $k => $item) {
      list($controller,$action) = explode(':',$item);
      if($controller == '*') $controller = $options['controller'];
      $results[$k]['name'] = Action::getName($action,$controller,$options['shortName']);
      $results[$k]['url'] = DS . $controller . DS . $action;
      $results[$k]['options']['class'] = $controller . ' ' . $action;
      $results[$k]['options']['disabled'] = !User::isAuthorized($controller,$action);
    }
    return $results;
  }

  /**
   * Return list of actions (without real name)
   * @param array $options{context, controller, action}
   * @return array available actions
   * @access protected
   */
  function __get($options=null){
    if(!isset($options)) return;
    $controller = $options['controller'];
    $action = $options['action'];
    $context = $options['context'];

    // if tab defined use it
    $item = ':'.$action;
    if(isset($options['tab'])) {
      $item .= ':'.$options['tab'];
    }
    
    $results = array();
    $map = &Configure::read('App.actions.map');
    
    // get some action going or die trying
    if(isset($map[$context][$controller.$item])) {
      $results = $map[$context][$controller.$item];
    } elseif(isset($map[$context][$controller.':'.$action.':*'])){
      $results = $map[$context][$controller.':'.$action.':*'];
    } elseif(isset($map[$context]['*'.$item])){
      $results = $map[$context]['*'.$item];
    } elseif(isset($map[$context]['*:'.$action.':*'])){
      $results = $map[$context]['*:'.$action.':*'];
    }
    return $results;
  }

  /**
   * Return the list of available actions
   * @param $action string the action generic name
   * @param $controller string the controller name, can be null
   * @param $short boolean priviledge short name over full blown?
   */
  static function getName($action,$controller=null,$short=false){
    $list = &Configure::read('App.humanize.actions');
    
    if(!$short && isset($controller) && isset($list[$controller.':'.$action])){
      return $list[$controller.':'.$action];
    }
    if(isset($list[$action])){
      return $list[$action];
    }
    if(isset($list['*:'.$action])){
      return $list['*:'.$action];
    }
    if($short && isset($controller) && isset($list[$controller.':'.$action])){
      return $list[$controller.':'.$action];
    }
    //Ddisplay missing on debug otherwise humanize
    if(Configure::read('debug') == 0){
      return Inflector::humanize($action);
    }
    return '[error:missing_name]';
  }
}//_EOF
?>
