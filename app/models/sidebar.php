<?php
/**
 * Sidebar Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org 
 * @package     greenpeace.boost.model.sidebar
 * 
 * This Model is responsible for providing the sidebar boxes to the site
 * depending on what section the user is visiting & his/her role.
 */
class Sidebar extends AppModel{
  var $useTable = false; // content is not stored in DB
  
  /**
   * Get the siderbar for a given section
   * @param $section name
   */
  function get($options = null) {
    $results = array();
    if(!isset($options) || empty($options)) {
       return $results;
    }
    
    $section = isset($options['section']) ? $options['section'] : null;
    $controller = $options['controller'];
    $action = $options['action'];
    
    $widgets = $this->__getSidebarElements($section);

    // check permissions
    // 1. sidebar inclusion rules for controller:action
    // 2. user/role rights to access sidebar:widget
    foreach ($widgets as $key => $widget) {
      if(Common::requestAllowed($controller, $action, $widget['rules']) 
         && User::isAllowed($controller,$action)) {
        $results[$key] = $widget;
      }
    }
    
    // pr($results);
    // die;
    
    return $results;
  }

  /**
   * Return the list of the elements to be included in the Sidebar view
   * @param $section if your app have multiple sidebars
   * @return array mixed
   */
  function __getSidebarElements($section=null) {
    $section = isset($section) ? $section : 'sidebar';
    $map = array(
      'sidebar' => array(
        'shortcuts' => array(
          'name'    => __('Shortcuts',true),
          'rules'   => '*:*,!users:login,!users:forgot_password',
          'class'   => 'inline'
        ),
        'favorites' => array(
          'name'    => __('Favorites',true),
          'rules'   => '*:*,!users:login,!users:forgot_password',
          'class'   => 'inline'
        )
       /*'help' => array(
          'name'    => __('Help', true),
          'rules'   => '*:*'
        )*/
      )
    );
    
    if(isset($map[$section])) {
      return $map[$section];
    } else return array();
  }

}//_EOF
?>