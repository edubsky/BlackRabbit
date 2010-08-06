<?php
/**
 * Favorites controller
 * Control the starred items
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.favorites
 */
class FavoritesController extends AppController {
  
  /**
   * Before filter function redefinition
   * @see Controller::beforeFilter
   */
  function beforeFilter() {
    parent::beforeFilter();
    $this->models = array_keys(Configure::read('Favorites.models'));
    foreach ($this->models as $model) {
      $this->$model = ClassRegistry::init($model);
      $this->Favorite->bindModel(
        array('belongsTo' => array(
          $model => array('foreignKey' => 'foreign_id')
        ))
      );
    }
  }
  
  /**
   * Index: list of favorited items for a given model
   * @param string $model 
   */
  function index($model = 'all') {
    if ($model == 'all') {
      $model = $this->models;
    } else {
      if (!in_array($model, $this->models))
        $model = $this->models;
      else $model = array($model);
    }
    $favorites = $this->Favorite->find('all', array(
      'contain' => $model,
      'order' => array('Favorite.created' => 'desc')
    ));
    $this->set(compact('favorites', 'model'));
  }
  
  /**
   * Add a favorite for a given user
   * @param UUID $id
   * @param string $model
   */
  function add($id = null, $model = false) {
    $userId = User::get('id');
    $favorite = $this->Favorite->find('first', array(
      'conditions' => array('user_id' => $userId, 'foreign_id' => $id)
    ));
    $model = empty($model) ? 'object' : $model;
    if (empty($favorite)) {
      $this->Favorite->create(array(
        'user_id' => $userId,
        'foreign_id' => $id,
        'model' => $model
      ));
      $this->Favorite->save();
      $this->Favorite->load(User::get('id'));
      $msg = __('This record was successfully starred!', true);
      return $this->Message->add($msg, 'notice');
    }
    $msg = __('This record was already starred!', true);
    $this->Message->add($msg, 'warning');
  }
  
  /**
   * Unfav/unstar a given record for a given model
   *
   * @param UUID $id
   * @param string $model
   */
  function delete($id = null, $model = false) {
    $userId = User::get('id');
    $favorite = $this->Favorite->find('first', array(
      'conditions' => array('user_id' => $userId, 'foreign_id' => $id)
    ));
    $model = empty($model) ? 'object' : low($model);
    if (empty($favorite)) {
      $msg = __('Uh oh, playing some tricks on me?! This record was not starred in the first place!');
      return $this->Message->add($msg, 'warning');
    }
    $this->Favorite->del($favorite['Favorite']['id']);
    $this->Favorite->load(User::get('id'));
    $msg = __('This record was sucessfully removed from your starred item list.', true);
    $this->Message->add($msg, 'notice');
  }
}//_EOF
?>