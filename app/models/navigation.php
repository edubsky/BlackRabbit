<?php
/**
 * Navigation Model
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenepeace.org
 * @package     app.model.navigation
 * 
 * This Model is responsible for providing the navigation to the site
 * depending on what section the user is visiting & his/her role.
 */
class Navigation extends AppModel{
  var $useTable = false; // content is not stored in DB
  
  /**
   * Get the navigation for a given section
   * @param $section name
   */
  function get($section = null) {
    //$Session = Common::getComponent('Session');
    if($section == null) $section = 'main.admin';
    $navigations = &Configure::read('App.navigation.'.$section);
    
    return $navigations;
    if (isset($navigations[$section])) {
      return $navigations[$section];
    } else {
      return array(); 
    }
  }
}//_EOF
?>