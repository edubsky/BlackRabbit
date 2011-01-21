<?php
/**
 * Sidebar Helper
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     boost.views.helpers.sidebar
 */
class SidebarHelper extends Apphelper {
  var $helpers = array('Html');
  var $model;

  /**
   * Before Render hook function
   * @see AppHelper::beforeRender
   */
  function beforeRender() {
    if (!isset($this->model)) {
      $this->model = ClassRegistry::init('Sidebar'); // initialize model or get it back
    }
  }

  /**
   * Get the sidebar list (helper to model)
   * @param $options array
   * @return array list of sidebar
   */
  function get($section=null,$options=array()) {
    $defaults = array(
      'controller' => $this->params['controller'],
      'action'     => $this->params['action'],
      'section'    => $section
    );
    $options = array_merge($defaults,$options);
    $sidebar = $this->model->get($options);
    return $sidebar;
  }
}//_EOF
?>
