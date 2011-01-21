<?php
/**
 * Favorite button on index
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.tables.favorites
 */
  $enabled = Configure::read('App.favorites.enabled');
  $class = isset($class) ? $class : 'favorites';
  $tag = isset($tag) ? $tag : 'td';
  $selected = isset($selected) ? $selected : null;
?>
<?php
if (isset($enabled) && $enabled):
if (isset($model) && isset($id)) : ?>
    <<?php echo $tag; ?> class="<?php echo $class;?>">
      <?php echo $favorites->link($id,$model,$selected); ?>
    </<?php echo $tag; ?>>
<?php else: ?>
    <th class="<?php echo $class;?>">&nbsp;</th>
<?php endif; ?>
<?php endif; ?>
