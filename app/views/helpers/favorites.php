<?php
/**
 * Favorites (starred items) Helper
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.helpers.favorites
 */
class FavoritesHelper extends Apphelper {
  var $helpers = array('Html');
  var $config;

  /**
   * Before render hook function
   *
   * @return void
   * @access public
   */
  function beforeRender() {
    //$this->config = Configure::read('App.favorites');
    $this->config['icons'] = array(
      'fav'   => '/img/icons/S/rate.png',
      'unfav' => '/img/icons/S/unrate.png'
    );
  }

  /**
   * Generate a link with the proper stared/unstared picture
   * @param $model
   * @param $uuid
   * @return string link
   */
  function link($uuid,$model,$isFavorited=null) {
    if(is_null($isFavorited)){
      $isFavorited = ClassRegistry::init('Favorite')->isFavorited($uuid,$model);
    }
    if (!$isFavorited) {
      $img = $this->Html->image(
        $this->config['icons']['unfav'],
        array('alt'=> __('unmark as favorite', true))
      );
      return $this->Html->link($img, array(
        'controller' => 'favorites', 'action' => 'add', $uuid, $model
        ), array('class' => 'star', 'escape'=>false
      ));
    } else {
      $img = $this->Html->image(
        $this->config['icons']['fav'],
        array('alt'=> __('mark as favorite', true))
      );
      return $this->Html->link($img, array(
        'controller' => 'favorites', 'action' => 'delete', $uuid, $model
        ), array('class' => 'star', 'escape'=>false
      ));
    }
  }

  /**
   * Select all link
   * @param $model
   * @return string link
   */
  function favalllink($model=null){
    return $this->Html->image($this->config['icons']['fav']);
  }
}//_EOF
?>
