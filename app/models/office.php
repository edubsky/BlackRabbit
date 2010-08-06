<?php
/**
 * Office Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org 
 * @package     greenpeace.boost.model.office
 */
class Office extends AppModel {
  var $displayField = 'name';
  var $actsAs = array(
    //'SavedBy'
  );
  var $hasMany = array(
    'User'
  );
}
?>