<?php
/**
 * Address Model
 * Manage user preferences
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.address
 */
class Address extends AppModel {
  var $name = 'address';
  var $belongsTo = array(
    'User',
    'City',
    'State',
    'Country'
  );
}
?>