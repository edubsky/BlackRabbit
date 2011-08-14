<?php
/**
 * Application Model
 * All models inherit from this one
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.app_model
 */
class AppModel extends Model {
  var $actsAs = array('Containable');

  /**
   * Never fetch any recursive data from associated models
   * Use containable for any assocs
   * @var integer
   */
  public $recursive = -1;

  static function getName($name){
    return Configure::read('App.humanize.objects.'.$name);
  }

  /**
   * Check if two field values are equal (as in password confirmation)
   * @param array $field check
   * @param string $field2 as in 'User.password_confirm'
   * return boolean
   */
  function isConfirmed($field, $field2) {
    list($model,$field3) = (preg_split('/\./',$field2));
    return($this->data[$model][$field3] == current($field));
  }
}//_EOF
