<?php
/**
 * Favorite Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.model.favorite
 */
class Favorite extends AppModel{
  var $belongsTo = array('User');
  var $deleteFields = array('deleted', 'archived', 'softdeleted'); // fiter out the inactive/archive stuffs

  /**
   * Do for model
   *
   * @param string $model 
   * @return void
   * @access public
   */
  function doForModel($model) {
    $favConfig = Configure::read('App.favorites');
    return in_array($model, array_keys($favConfig['models']));
  }
  
  /**
   * Load the favorites for a given user
   *
   * @param string $userId 
   * @return void
   * @access public
   */
  function load($userId) {
    $conditions = array('Favorite.user_id' => $userId);
    $favConfig = Configure::read('App.favorites');
    
    if (isset($favConfig['conditions'])) {
      $conditions = am($conditions, $favConfig['conditions']);
    }

    $models = array_keys($favConfig['models']);

    $options = $hasManyOptions = array();
    foreach ($models as $model) {
      $options[$model] = array('foreignKey' => 'foreign_id');

      $Model = ClassRegistry::init($model);
      $Model->bindModel(array('hasMany' => array(
        'Favorite' => array(
          'dependent' => true,
          'foreignKey' => 'foreign_id'
        )
      )), false);

      foreach ($this->deleteFields as $field) {
        if (array_key_exists($field, $Model->_schema)) {
          $alias = $Model->alias;
          $conditions[] = '(' . $alias . '.' . $field . '= "0" || ' . $alias . '.id IS NULL)';
        }
      }
    }
    $this->bindModel(array('belongsTo' => $options), false);
    
    $favorites = $this->find('all', array(
      'conditions' => $conditions,
      'contain' => $models,
      'fields' => array('Favorite.foreign_id', 'Favorite.model', 'Favorite.user_id')
    ));

    $Session = Common::getComponent('Session');

    $simple = Set::extract('/Favorite/foreign_id', $favorites);
    $Session->write('favorites', $simple);

    $verbose = array();
    foreach ($models as $model) {
      $verbose[$model] = 0;
      foreach ($favorites as $fav) {
        if (!empty($fav['Favorite']['foreign_id']) && !empty($fav[$model]['id'])) {
          $verbose[$model]++;
        }
      }
    }
    $Session->write('verbose_favorites', $verbose);
  }
  
  /**
   * Indicates if a resource is marked as favorite
   *
   * @param string $id UUID of the resource
   * @return bool
   * @access public
   */
  function isFavorited($id) {
    $Session = Common::getComponent('Session');
    return in_array($id, $Session->read('favorites'));
  }
}