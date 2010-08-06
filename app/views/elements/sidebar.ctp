<?php 
/**
 * Sidebar Element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.elements.navigation
 */
  // Fix stupid behavior for missing components, etc. +> only load default helpers
  if(!isset($this->Sidebar)) return; 
  $urlBase = 'sidebar'.DS;
  //$widgets = array('shortcuts','help');//'search', 'favorites', 'chat', 'shortcuts','news');
  $id = isset($id) ? $id : null;
  $widgets = $this->Sidebar->get($id);
?>
<?php foreach($widgets as $key => $widget): ?>
<?php   echo $this->element($urlBase.$key,$widget); ?>
<?php endforeach; ?>
<?php //echo $html->link(__('Save Widget Config', true), '#', array('class' => 'save-widgets'));?>
