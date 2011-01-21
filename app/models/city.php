<?php
/**
 * City Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.cities
 */
class City extends AppModel{
  /**
   * Belongs to Associations
   * @var array $belongsTo
   */
  var $belongsTo = array(
    'State', 
    'Country'
  );
  
  /**
   * Validation rules
   * @var array $validate
   */
  var $validate = array(
    'id' => array(
      'rule' => 'blank',
      'on' => 'create'
    ),
    'name' => array(
      'required' => array(
        'rule' => 'notEmpty',
        'is_required' => true,
        'last' => true
      ),
      'valid' => array(
        'rule' => array('custom', '/^[\p{Ll}\p{Lo}\p{Lt}\p{Lu} ]+[\-,]?[ ]?[\p{Ll}\p{Lo}\p{Lt}\p{Lu} ]+$/'),
        'message' => 'Please provide a valid city name.',
      ),
      'length' => array(
        'rule' => array('minLength', '2'),
      ),
    ),
    'country_id' => array(
      'required' => array(
        'rule' => 'notEmpty',
        'message' => 'The country is required!',
        'is_required' => true,
        'last' => true
      ),
      'notEmpty' => array(
        'rule' => 'notEmpty',
      ),
      'valid' => array(
        'rule' => array('validateCountry'),
      )
    ),
    'state_id' => array(
      'valid' => array(
        'rule' => array('validateState'),
        'is_required' => false,
        'allowEmpty' => true,
      )
    )
  );
}
?>