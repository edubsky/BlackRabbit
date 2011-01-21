<?php
/**
 * Display Settings Components
 * Helps controllers deals with display settings
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.display_settings
 */
class displaySettingsComponent extends Object{
 /**
  * Initialize Callback
  * @param object $controller Controller using this component
  * @return boolean Proceed with component usage (true), or fail (false)
  */
  function initialize(&$controller,$settings=array()){
    $this->Controller = &$controller;
  }

  /**
   * Return the selected view mode if any
   * @return bollean|string, view mode name or false
   * @access getViewMode
   */
  function getViewMode() {
    $enabled = Configure::read('App.gui.viewModes.enabled');
    // check if different view modes are actives for this context
    $allowed = Common::requestAllowed(
      $this->Controller->name,
      $this->Controller->action,
      Configure::read('App.gui.viewModes.conditions')
    );
    // options must be enabled and allowed for controller:action
    if($enabled && $allowed) {
      // list allowed view modes
      $allowed = Configure::read('App.gui.viewModes.options');
      $urlName = Configure::read('App.gui.viewModes.urlName');
      $requested = array();
      if(isset($this->Controller->params['named'][$urlName]) && isset($allowed[$this->Controller->params['named'][$urlName]])) {
        // check if the view mode is requested in the url
        $requested = $this->Controller->params['named'][$urlName];
        User::setValue('Preference.gui.viewModes.default',$requested);
      } elseif(User::get('Preference.gui.viewModes.default')) {
        // check if there was any preferences in the past
         $requested = User::get('Preference.gui.viewModes.default');
      } else {
        // default option
        $requested = Configure::read('App.gui.viewModes.default');
      }
      return $requested;
    }
   return false;
  }
}//_EOF
