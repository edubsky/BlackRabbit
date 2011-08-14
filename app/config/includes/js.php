<?php
/**
 * Javascript Files inclusion rules
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.config.includes.js
 */
$config = array(
  'JsIncludes' => array(
    'jquery-1.4.2.min.js' => array(
      'rules' => '*:*'
    ),
    'font_resize.js' => array(
      'rules' => '*:*,!users:login,!users:forgot_password'
    ),
    'dropdown.js'=> array(
      'rules' => '*:*,!users:login,!users:forgot_password'
    ),
    /*'splitter.js' => array(
      'rules' => '*:*,!users:login,!users:forgot_password'
    )*/
  )
);

// SPECIAL INCLUDES
// @todo move to elements/css_includes + user preference
// For features that are enabled/disabled in config
// Table collumn resize
if (Configure::read('App.gui.tables.resizable')) {
  $config['JsIncludes'] = array_merge($config['JsIncludes'], array(
    'jquery.event.drag.js' => array(
      'rules' => '*:index'
    ),
    'tables.resizable.js' => array(
      'rules' => '*:index'
    )
  ));
}
// Toolltips
if (Configure::read('App.gui.tooltips.enabled') && User::get('Preference.gui.tooltips.enabled')) {
  $config['JsIncludes']['tooltips'] = array(
    'rules' => '*:*'
  );
}
// Cookie check
if (User::isGuest()) {
 $config['JsIncludes']['cookiecheck'] = array(
    'rules' => '*:*'
  );
}
// MAIN - last but not least
$config['JsIncludes']['main'] = array('rules' => '*:*');

//_EOF
