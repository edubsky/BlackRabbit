<?php
/**
 * Role Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.model.role
 */
class Role extends AppModel {
  var $displayField = 'name';
  var $actsAs = array(
  );
  var $hasMany = array(
    'User'
  );
}
?>