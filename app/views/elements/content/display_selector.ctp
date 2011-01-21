<?php
/**
 * Display / View type selector
 * Allow displaying a view as table, icons, list;
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.display_selector
 */
  $title = isset($title) ? $title : __('display as',true);
  $div   = isset($div)   ? $div   : true;
  $ds = &$this->DisplaySettings;
?>
<?php if($div) : ?>
  <div class='display selector'>
<?php endif; ?>
<?php if($title) : ?>
    <h4><?php echo $title; ?>:</h4>
<?php endif; ?>
<?php if(isset($ds->viewModeOptions) && count($ds->viewModeOptions)):
         $max = count($ds->viewModeOptions) -1 ; ?>
    <ul class="<?php echo $ds->useIcons(); ?>">
<?php foreach($ds->viewModeOptions as $i => $mode):
       $class = ($i == 0) ? 'first ' : '';
       $class.= ($i == $max) ? 'last ' : '';
       $class.= $ds->isViewModeSelected($mode);
?>
      <li class='<?php echo $class; ?>'><?php echo $ds->viewModelink($mode); ?></li>
<?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if($div) : ?>
  </div>
<?php endif; ?>
