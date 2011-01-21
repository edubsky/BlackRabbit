<?php
/**
 * Favoritable Behavior
 * Allow adding favorites
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.behaviors.favoritable
 */
class FavoritableBehavior extends ModelBehavior {

  /**
   * Contain settings indexed by model name.
   * @var array
   * @access private
   */
  var $__settings = array();

  /**
   * Initiate behavior for the model using settings.
   *
   * @param object $Model Model using the behaviour
   * @param array $settings Settings to override for model.
   * @access public
   */
  function setup(&$Model, $settings = array()){
    $Model->bindModel(array('hasOne' => array(
      'Favorite' => array(
        'dependent' => true,
        'foreignKey' => 'foreign_id',
        'conditions' => array('user_id' => User::get('id'))
      )
    )), false);
  }
}//_EOF

