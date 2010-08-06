<?php
/**
 * User Index View
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     blackrabbit.views.users.index.ctp
 */
  $title_for_layout = __('User Index',true);
  $this->set('title_for_layout',$title_for_layout);
  $urlBase = 'content'.DS;
  $this->DisplaySettings->setOptions(array('table'));
  /*$options = array(
    'model' => 'User',
    // @TODO use config instead
    'select' => array(
      'enabled' => true,
      'allowempty' => true,
    )
  );*/
?>
<?php echo $this->element('content'.DS.'content_header'); ?>
<?php if(!count($users)): ?>
  <p class='empty'><?php __('Sorry there is nothing to display here'); ?></p>
<?php else: ?>
  <table cellpadding="0" cellspacing="0">
    <tr>
<?php echo $this->element($urlBase.'tables'.DS.'select'); ?>
<?php echo $this->element($urlBase.'tables'.DS.'favorites'); ?>
      <th style="min-width:100px;"><?php echo $this->MyPaginator->sort('name');?></th>
      <th style="min-width:250px;"><?php echo $this->MyPaginator->sort('description');?></th>
      <th class="datetime"><?php echo $this->MyPaginator->sort('created');?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
<?php
  $i = 0; $max = count($users); $class='';
  foreach ($users as $user):
    if ($max > 2) $class = ($i++ % 2 == 0) ? 'altrow' : null ;
    $options['select']['id'] = $options['favorites']['id'] = $user['User']['id'];
?>
    <tr class='<?php echo $class;?>'>
<?php echo $this->element($urlBase.'tables'.DS.'select'); ?>
<?php echo $this->element($urlBase.'tables'.DS.'favorites'); ?>
      <td><?php echo $user['User']['name']; ?>&nbsp;</td>
      <td><?php echo $user['User']['description']; ?>&nbsp;</td>
      <td><?php echo $user['User']['created']; ?>&nbsp;</td>
      <td class="actions">
        <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['id']), array('class'=>'edit')); ?> |
        <?php echo $this->Html->link(__('Archive', true), array('action' => 'archive', $user['User']['id']), array('class'=>'archive')); ?> 
      </td>
    </tr>
<?php endforeach; ?>
  </table>
<?php echo $this->element($urlBase.'paging'); ?>
<?php endif; ?>
<?php echo $this->element($urlBase.'content_footer'); ?>
