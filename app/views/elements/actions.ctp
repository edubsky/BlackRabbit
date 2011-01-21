<?php
/**
 * Actions element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.actions
 */
  // Set up the default display options
  $displayEmpty = isset($displayEmpty) ? $displayEmpty : true;
  $displayWrapper = isset($displayWrapper) ? $displayWrapper : true;
  $displayHeader = isset($displayHeader) ? $displayHeader : true;
  $displayList = isset($displayList) ? $displayList : true;
  $wrapperClass = isset($wrapperClass) ? $wrapperClass : 'actions';
  $listClass = isset($listClass) ? $listClass : 'actions';
  $delimiter = isset($delimiter) ? $delimiter : ' | ';
  $shortName = isset($shortName) ? $shortName : false;
  $useIcons = (isset($useIcons) && !$useIcons) ? '' : $this->DisplaySettings->useIcons();
  $useIconsOnly = isset($useIconsOnly) ? $useIconsOnly : false;
  $showDisabled = isset($showDisabled) ? $showDisabled : $this->DisplaySettings->showDisabledLinks();

  // Set up the context and get the actions list
  $context = isset($context) ? $context : 'default';
  $id = isset($id) ? DS. $id : '';
  $_actions = isset($_actions) ? $_actions : // actions could be provided
    $this->Actions->get(array(               // or deduced from context (@see ActionsHelper::get)
      'context' => $context,
      'shortName' => $shortName
    ));
  $_actionCount = count($_actions);
?>
<?php if($displayWrapper): ?>
  <div class='<?php echo $wrapperClass; ?>'>
<?php endif; ?>
<?php if($displayHeader): ?>
    <h3><?php __('Actions'); ?></h3>
<?php endif; ?>
<?php if($displayList): ?>
    <ul class='<?php echo $listClass; ?>'>
<?php endif; ?>
<?php if(isset($_actions) && $_actionCount): $i=0;
        foreach($_actions as $name => $item): $i++;
          $item['options']['class'] .= ' '.$useIcons;
//          if($showDisabled && isset($item['disabled']) && $item['disabled'])
  //           $item['options']['class'] .= ' disabled';
          if($displayList): ?>
      <li><?php echo $this->MyHtml->link($item['name'],$item['url'].$id,$item['options']); ?></li>
<?php     else: ?>
        <?php echo $this->MyHtml->link($item['name'],$item['url'].$id,$item['options']); ?>
<?          if($_actionCount != $i && (!$item['options']['disabled'] || ($item['options']['disabled'] && $this->DisplaySettings->showDisabledLinks())))
             echo $delimiter; echo "\n";
          endif;
        endforeach;
      elseif($displayEmpty): ?>
      <li class="empty"><?php echo __('Sorry, but there is nothing to do here'); ?></li>
<?php endif; ?>
<?php if($displayList): ?>
    </ul>
<?php endif; ?>
<?php if($displayWrapper): ?>
  </div>
<?php endif; ?>
