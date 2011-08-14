<?php
/**
 * Configuration for Actions Menus
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.config.actions
 */
$config = array(
  'App.actions' => array(
    // Actions map for navigation / menu
    // Default pattern is {menu_context}{controller:action[:tab]} 
    // as in users/index/archived actions
    'map' => array(
      // Default Context
      // Main action bar
      'default' => array(
        // Catch all, no pain no gain!
        //'*:*' => array(),
        // Catch all default actions only if controller:
        '*:index:*' => array(
          'pages:home', '*:add' //, 'batch_edit', 'batch_export', 'batch_import'
        ),
        '*:add' => array(
          '*:index'
        ),
        '*:edit' => array(
          '*:index'
        ),
        // Special redefinition at controller level
        '*:index:archived' => array(
          'pages:home','*:restore'
        ),
      ),
      // Row Context
      // Actions available for a given item when listing items (on an index page)
      'row' => array(
        '*:index:*' => array(
          '*:edit','*:archive'
        ),
        '*:index:archived' => array(
          '*:edit','*:restore'
        )
      )
    )
  )
);
//_EOF
?>
