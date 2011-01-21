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
  
  /**
   * Get a country ID by its name
   * @param string $name 
   * @return array $country
   */
  function getIdByName($name = 'United States') {
    return ClassRegistry::init(__CLASS__)->lookup(
      array('name' => $name), 'id', false
    );
  }
}
?>