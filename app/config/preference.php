<?php
/**
 * Default user preference configuration file
 *
 * @copyright 2010 (c) Greenpeace International
 * @author    remy.bertot@greenpeace.org
 * @package   app.config.preference
 */
$config = array(
  // Default locale
  'Locale' => array(
    'currency' => 'EUR',
    'date' => array(
      'format' => 'd/m/y h:m:s',
      'timezone' => 'Netherland/Amsterdam'
    )
  ),
  // Graphical user interface preference
  'Preference.gui' => array(
    // Would like some javascript?
    'javascript' => array(
      'enabled' => true
    ),
    // Sidebar style
    'sidebar' => array(
      'position' => 'right'   // right or left (nothing changes!)
    ),
    // Messages
    'messages' => array(
      'style' => 'inline'     // message style: centered 'dialog' box or 'inline'
    ),
    'tooltips' => array(
      'enabled' => true
    ),
    // Would you like some iconic polution?
    'icons' => array(
      'enabled' => true,
    ),
    // View mode : compact, list, icons
    'viewModes' => array(
      'default' => 'list'
    )
  )
);
?>
