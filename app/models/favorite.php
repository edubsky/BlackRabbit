<?php
/**
 * Favorite Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.favorite
 */
class Favorite extends AppModel{
  var $belongsTo = array('User');

  /**
   * Do for model
   *
   * @param string $model
   * @return void
   * @access public
   *
  function doForModel($model) {
    $favConfig = Configure::read('App.favorites');
    return (isset($favConfig['models'][$model]) && $favConfig['models'][$model]);
  }
 */
  /**
   * Load the favorites for a given user
   *
   * @param string $userId
   * @return void
   * @access public
   *
  function load($userId,$archived=false) {

    $Session = Common::getComponent('Session');

    // Dont fetch if favs are in session
    if($Session->check('favorites')) {
      return;
    }

    // Get potential models from list
    $favConfig = Configure::read('App.favorites');
    $models = array_keys($favConfig['models'],true);

    // Bind the models and build the search conditions
    $options = $hasManyOptions = array();
    $conditions = array('Favorite.user_id' => $userId);
    foreach ($models as $model) {
      $options[$model] = array('foreignKey' => 'foreign_id');
      $Model = ClassRegistry::init($model);
      $Model->bindModel(array('hasMany' => array(
        'Favorite' => array(
          'dependent' => true,
          'foreignKey' => 'foreign_id'
        )
      )), false);

      // dont retrieve archived records unless required
      $this->deleteFields = Configure::read('App.softdelete');
      foreach ($this->deleteFields as $field) {
        if (array_key_exists($field, $Model->_schema)) {
          $alias = $Model->alias;
          $value = $archived ? '1' : '0';
          $conditions[] = '(' . $alias . '.' . $field . '='. $value . ' || ' . $alias . '.id IS NULL)';
        }
      }
    }
    $this->bindModel(array('belongsTo' => $options), false);

    // Search for faved records
    $favorites = $this->find('all', array(
      'conditions' => $conditions,
      'contain' => $models,
      'fields' => array('Favorite.foreign_id', 'Favorite.model', 'Favorite.user_id')
    ));

    // Save the result in session for later use
    $fav = array();
    foreach ($favorites as $favitem) {
      //$model_sing = ucfirst(Inflector::singularize($favitem['Favorite']['model']));
      $model_sing = ucfirst($favitem['Favorite']['model']);
      $fav[$model_sing][] = $favitem[$model_sing]['id'];
    }
    $Session->write('favorites', $fav);
    //pr($fav);die;
  }
   */

  /**
   * Indicates if a resource is marked as favorite
   *
   * @param string $foreign_id UUID of the resource
   * @param string $model name of the resource type
   * @return bool
   * @access public
   */
  static function isFavorited($foreign_id,$model=null) {
    $_this = &ClassRegistry::init('Favorite');
    $conditions =  array(
      'conditions' => array(
        'model' => $model,
        'user_id' => User::get('id'),
        'foreign_id' => $foreign_id
      ),
      'fields' => array(
        'id'
      )
    );
    $favorites = $_this->find('first',$conditions);
    return !empty($favorites);
  }

  /**
   * STATIC Get all the favorites items (from session)
   * @return array $favorites
   static function getAll() {
     $Session = Common::getComponent('Session');
     return $Session->read('favorites');
   }
   */

  /**
   * STATIC Get the number of faved items per model
   * @return string $archived {true, false, both}
   * @return array $favorites
   */
  static function getAllCount($archives=true) {
    $_this = &ClassRegistry::init('Favorite');

    // Get potential models from list
    $models = @array_keys(Configure::read('App.favorites.models'),true);

    // default condition
    $conditions =  array(
      'conditions' => array(
        'model' => $models,
        'user_id' => User::get('id')
      ),
      'fields' => array(
        'model',
        'COUNT(model) as count'
      ),
      'group' => array(
        'Favorite.model'
      )
    );

    // Bind the models if the search depends on record's status
    if ($archives!='both' && is_bool($archives)) {
      Favorite::__bindArchivableModels(&$_this, &$models,&$conditions,$archives);
    }

    // Search for faved records
    $favorites = $_this->find('all',$conditions);
    //pr($favorites);

    //tidy up
    foreach ($favorites as $i => $fav) {
      $favorites[$i]['Favorite']['count'] = $fav[0]['count'];
      unset($favorites[$i][0]);
    }

    return $favorites;
  }

  /**
   * STATIC - Prepare static find
   * Bind models and define default find conditions
   * @param $_this instance of Favorites model
   * @param $conditions find conditions
   * @access private
   * @TODO move in archivable behavior?
   */
  static function __bindArchivableModels(&$_this, &$models, &$conditions,$archived) {
    $softDeleteModels = @array_keys(Configure::read('App.softdelete.models'),true);
    $softDeleteFields = Configure::read('App.softdelete.fields');
    $models = array_intersect($models, $softDeleteModels);
    $options = $hasManyOptions = array();

    //$conditions = array('Favorite.user_id' => User::get('id'));
    foreach ($models as $i => $model) {
      $options[$model] = array('foreignKey' => 'foreign_id');
      $Model = ClassRegistry::init($model);
      $Model->bindModel(array('hasMany' => array(
        'Favorite' => array(
          'dependent' => true,
          'foreignKey' => 'foreign_id'
        )
      )), false);

      // dont retrieve archived records unless required
      foreach ($softDeleteFields as $field) {
        if (array_key_exists($field, $Model->_schema)) {
          $alias = $Model->alias;
          $value = $archived ? '1' : '0';
          $conditions['conditions'][] = '(' . $alias . '.' . $field . '='. $value . ' || ' . $alias . '.id IS NULL)';
        }
      }
    }
    $conditions['contain'] = $models;
    $_this->bindModel(array('belongsTo' => $options), false);
  }
}//_EOF
?>
