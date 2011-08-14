<?php
/**
 * Country Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.country
 */
class Country extends AppModel{
  /**
   * Has many association
   * @var array $ĥasMany
   */
  var $hasMany = array(
  	'State'
  );
}
?>