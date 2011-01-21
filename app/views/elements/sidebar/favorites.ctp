<?php
/**
 * Favorites Sidebar Box
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.sidebar.favorites
 */
  if(!ClassRegistry::isKeySet('Favorite')) {
    ClassRegistry::init('Favorite');
  }
  $favorites = Favorite::getAllCount();
?>
<?php $widgets->header(	'favorites',__('Favorites',true),array('toogle' => true)); ?>
<?php if(sizeof($favorites)): ?>
      <ul class='with_bullets'>
<?php foreach($favorites as $i => $object) :
  $name_plur = Inflector::pluralize($object['Favorite']['model']);
  $name = ($object['Favorite']['count']>1) ? $name_plur : $object['Favorite']['model'];
  $name = Favorite::getName($name);
?>
        <li><?php
          $label =  $name.' ('. $object['Favorite']['count'] . ')';
          echo $this->MyHtml->link($label, array(
            'controller' => strtolower($name_plur),
            'action' => 'index', 'favorites',
            'plugin' => ''
          ));
          ?></li>
<?php endforeach; ?>
      </ul>
<?php else: ?>
      <p><?php echo __('You can add items to this favorite list by starring them.',true); ?></p>
<?php endif; ?>
<?php $widgets->footer(); ?>
