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
}//_EOF

