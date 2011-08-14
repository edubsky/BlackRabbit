<?php
/**
 * Shortcuts element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.shortcuts.ctp
 */
 $ul_class = $div_class = '';
 if($this->DisplaySettings->useIcons('bool')){
   $ul_class = 'with_icon ';
   $div_class = ' inline';
 }
 $ul_class .= $this->DisplaySettings->useTooltips();
?>
  <div class='shortcuts<?php echo $div_class; ?>'>
    <h3><?php __('Shortcuts'); ?>:</h3>
    <ul class='<?php echo $ul_class; ?>'>
      <li><a href="javascript:addFavorite()" class="<?php echo $ul_class; ?> bookmark" title="<?php echo __('Bookmark this page', true); ?>"><span><?php echo __('Bookmark this page', true); ?></span></a></li>
      <li><a href="javascript:printThis()" class="<?php echo $ul_class; ?> print" title="<?php echo __('Don\'t print this page', true); ?>"><span><?php echo __('Don\'t print this page', true); ?></span></a></li>
      <li><a href="<?php echo Router::url(); ?>#" class="<?php echo $ul_class; ?> fontResize increase" title="<?php echo __('Increase the font size', true); ?>"><span><?php echo __('Increase the font size', true); ?></span></a></li>
      <li><a href="<?php echo Router::url(); ?>#" class="<?php echo $ul_class; ?> fontResize decrease" title="<?php echo __('Decrease the font size', true); ?>"><span><?php echo __('Decrease the font size', true); ?></span></a></li>
      <li><a href="logout" class="<?php echo $ul_class; ?> logout" title="<?php echo __('Logout', true); ?>"><span><?php echo __('Logout', true); ?></span></a></li>
    </ul>
  </div>
