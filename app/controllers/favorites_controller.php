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
    $this->models = array_keys(Configure::read('App.favorites.models'),true);
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
   * Add a favorite for a given user
   * @param UUID $id
   * @param string $model
   */
  function add($id, $model = false) {
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
      return $this->Message->notice($msg,true);
    }
    $msg = __('This record was already starred!', true);
    $this->Message->warning($msg,true);
  }

  /**
   * Unfav/unstar a given record for a given model
   *
   * @param UUID $id of the resource
   * @param string $model name
   */
  function delete($id,$model = false) {
    $userId = User::get('id');
    $favorite = $this->Favorite->find('first', array(
      'conditions' => array('user_id' => $userId, 'foreign_id' => $id)
    ));
    $model = empty($model) ? 'object' : strtolower($model);
    if (empty($favorite)) {
      $msg = __('Uh oh?! This record was not starred in the first place!',true);
      return $this->Message->add($msg, 'warning',true);
    }
    $this->Favorite->delete($favorite['Favorite']['id']);
    $this->Favorite->load(User::get('id'));
    $msg = __('This record was sucessfully removed from your starred item list.', true);
    $this->Message->notice($message,true);
    //exit;
  }

}//_EOF
