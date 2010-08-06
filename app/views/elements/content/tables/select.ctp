<?php 
  $enabled = isset($select['enabled']) ? $select['enabled'] : false;
?>
<?php if (isset($enabled) && $enabled && isset($model)): ?>
<?php if(!isset($id)): ?>
    <th class="selection"><input name="<?php e($model); ?>" class="select all checkbox" type="checkbox"></th>
<?php else: ?>		
    <td class="selection"><input name="<?php e($model.'_'.$id); ?>" id="<?php e($model.'_'.$id); ?>" class="select checkbox" type="checkbox"></td>
<?php endif; ?>
<?php elseif (isset($allowEmpty) && $allowEmpty == true) : ?>
    <td class="selection">&nbsp;</td>
<?php endif; ?>