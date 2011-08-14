<?php
/**
 * Language Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.language
 */
class Language extends AppModel {
  var $displayField = 'name';
  var $actsAs = array(
  );
  var $hasMany = array(
    'User'
  );
}//_EOF