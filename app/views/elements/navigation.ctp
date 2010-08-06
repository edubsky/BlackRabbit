<?php
/**
 * Navigation Element
 * Used to generate Navigation and Menus
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.elements.navigation
 */
  if(!isset($this->Navigation)) 
    return; // Fix stupid behavior for missing components, etc. +> only load default helpers

  $id = isset($id) ? $id : null;
  $menu = $this->Navigation->get($id); 

  if(isset($menu) && !empty($menu)):
    $options = isset($options) ? am($this->Navigation->getDefaultOptions(),$options) 
      : $this->Navigation->getDefaultOptions(); 
    $t = $options['indent'];
    $div = $options['div'];
?>
<?php if($div):?>
  <div class='menu_wrapper <?php echo $options['class'] ?>'>
<?php echo "\n"; endif; ?>
  <ul class='<?php echo $options['class'] ?>' id='<?php echo $options['id'] ?>'>
<?php foreach ($menu as $name => $url) : ?>
    <li><?php echo $this->Navigation->link($name,$menu); ?></li>
<?php endforeach;?>
  </ul>
<?php if($div):?>
  </div><?php echo "\n"; endif; ?>
<?php endif; ?>
