<?php
/**
 * Role Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.model.role
 */
class Role extends AppModel {
  var $displayField = 'name';
  var $actsAs = array(
  );
  var $hasMany = array(
    'User'
  );
}//_EOF