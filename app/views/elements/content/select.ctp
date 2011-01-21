<?php
/**
 * Select button on index
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.elements.content.select.ctp
 */
  $enabled = isset($select['enabled']) ? $select['enabled'] : false;
  $tag = isset($tag) ? $tag : 'td';
?>
<?php if (isset($enabled) && $enabled && isset($model)): ?>
<?php if(!isset($id)): ?>
    <th class="selection"><input name="<?php echo $model; ?>" class="select all checkbox" type="checkbox"></th>
<?php else: ?>
    <<?php echo $tag; ?> class="selection"><input name="<?php echo $model.'_'.$id; ?>" id="<?php echo $model.'_'.$id; ?>" class="select checkbox" type="checkbox"></<?php echo $tag; ?>>
<?php endif; ?>
<?php elseif (isset($allowEmpty) && $allowEmpty == true) : ?>
    <<?php echo $tag; ?> class="selection">&nbsp;</<?php echo $tag; ?>>
<?php endif; ?>
