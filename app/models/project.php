<?php
/**
 * Project Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.model.project
 */
class Project extends AppModel {
  var $name = 'Project';
  var $displayField = 'name';

  var $actsAs = array(
    'Archivable', 'Favoritable'
  );

  var $hasMany = array(
  );

  var $validate = array(
    'name' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),/*
      'range' => array(
        'rule' => array('range'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
      'between' => array(
        'rule' => array('between'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),*/
    ),
    'archived' => array(
      'boolean' => array(
        'rule' => array('boolean'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
    ),
    'completed' => array(
      'boolean' => array(
        'rule' => array('boolean'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      ),
    ),
  );

  /**
   * STATIC - Return the find options to be used
   * @param string context
   * @return array
   */
  static function getFindOptions($case, &$data=null) {
    return array_merge(
      Project::getFindConditions($case, &$data),
      Project::getFindFields($case)
    );
  }

  /**
   * STATIC - Return the find fields to be used for a given context
   * @param string $case context ex: index:all, edit, etc.
   * @return $condition array
   */
  static function getFindFields($case='all', &$data=null) {
    switch($case) {
      case 'index:all':
      case 'index:archived':
        $fields = array(
          'contain' => array(
            'Favorite(id,user_id,model,created)',
          ),
          'fields' => array(
            'id','name','description','created'
          )
        );
      break;
      default:
        throw new exception('ERROR: User::GetFindFields case undefined');
      break;
    }
    return $fields;
  }

  /**
   * STATIC - Return the find conditions to be used in a given context
   * @param string $case context ex: index:all, edit, etc.
   * @return $condition array
   */
  static function getFindConditions($case='all',&$data=null) {
    switch($case) {
      case 'index:all':
        $conditions = array(
          'conditions' => array('archived'=>'0')
        );
      break;
      case 'index:archived':
        $conditions = array(
          'conditions' => array('archived'=>'1')
        );
      break;
      default:
        throw new exception('ERROR: Project::GetFindConditions case undefined');
      break;
    }
    return $conditions;
  }
}//_EOF
