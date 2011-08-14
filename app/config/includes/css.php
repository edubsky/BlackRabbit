<?php
/**
 * CSS
 * This file is loaded in bootstrap.php and manage
 * the css file inclusion
 *
 * @copyright 2010 (c) Greenpeace International
 * @author    remy.bertot@greenpeace.org
 * @package   app.config.includes.css
 */
$config = array(
  'CssIncludes' => array(
    'generic' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'rounded_corner' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'layout' => array(
      'rules' => '*:*,!*:login,!*:forgot_password',
      'media' => 'screen'
    ),
    /* @TODO conditional include */
    'messages' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'tables' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'header' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'navigation' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'content' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'form' => array(
      'rules' => '*:*',
      'media' => 'screen'
    ),
    'actions' => array(
      'rules' => '*:*,!users:login,!users:forgot_password',
      'media' => 'screen'
    ),
    'display_selector' => array(
      'rules' => '*:*,!users:login,!users:forgot_password',
      'media' => 'screen'
    ),
    'paging' => array(
      'rules' => '*:index,pages:display',
      'media' => 'screen'
    ),
    'sidebar'  => array(
      'rules' => '*:*,!users:login,!users:forgot_password',
      'media' => 'screen'
    ),
    'footer' => array(
      'rules' => '*:*,!users:login,!users:forgot_password',
      'media' => 'screen'
    ),
    // Pages specials'
    'login' => array(
      'rules' => 'users:login,users:forgot_password',
      'media' => 'screen'
    ),
    // Media specials
    'print' => array(
      'rules' => '*:*,!*:login,!*:forgot_password',
      'media' => 'print'
    )
  )
);
// CONDITIONAL INCLUDES
// Use different display if reset password as Guest
if (User::isGuest()) {
  $config['CssIncludes']['login']['rules'] .= ',*:reset_password';
  $config['CssIncludes']['actions']['rules'] .= ',!*:reset_password';
  $config['CssIncludes']['display_selector']['rules'] .= ',!*:reset_password';
  $config['CssIncludes']['sidebar']['rules'] .= ',!*:reset_password';
  $config['CssIncludes']['footer']['rules'] .= ',!*:reset_password';
  $config['CssIncludes']['print']['rules'] .= ',!*:reset_password';
}
// SPECIAL INCLUDES
// @todo move to elements/css_includes + user preference
// For features that are enabled/disabled in config
// Table Wrap
if(Configure::read('App.gui.tables.nowrap')){
  $config['CssIncludes']['table_nowrap'] = array(
    'rules' => '*:index',
    'media' => 'screen'
  );
}
// Table collumn resize
if(Configure::read('App.gui.tables.resizable')){
  $config['CssIncludes']['table_resizable'] = array(
    'rules' => '*:index',
    'media' => 'screen'
  );
}
// Breadcrumb
if(Configure::read('App.gui.breadcrumb.enabled')){
  $config['CssIncludes']['breadcrumbs'] = array(
    'rules' => '*:*',
    'media' => 'screen'
  );
}
// Debug stuffs
if(Configure::read('App.environment') == 'development'){
  $config['CssIncludes']['cake'] = array(
    'rules' => '*:*',
    'media' => 'screen'
  );
}
// USER PREFERENCE DRIVEN
// Tooltips / Contextual help
if(User::get('Preference.gui.tooltips.enabled')){
  $config['CssIncludes']['tooltips'] = array(
    'rules' => '*:*',
    'media' => 'screen'
  );
}
// Tooltips / Contextual help
if(User::get('Preference.gui.icons.enabled')){
  $config['CssIncludes']['icons'] = array(
    'rules' => '*:*',
    'media' => 'screen'
  );
}

//_EOF
