<?php
/**
 * Project Index Icon View
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.projects.index_icon
 */
  $title_for_layout = __('Project Index',true);
  $this->set('title_for_layout',$title_for_layout);
  $urlBase = 'content'.DS;
?>
<?php echo $this->element('content'.DS.'content_header'); ?>
<?php if(!count($projects)): ?>
  <p class='empty'><?php __('Sorry there is nothing to display here'); ?></p>
<?php else: ?>
  <div class='view icon'>
    <div class='paginator'>
      <?php echo __('Order by'); ?> :
      <?php echo $this->MyPaginator->sort(__('Name',true),'Project.name'); ?> |
      <?php echo $this->MyPaginator->sort(__('Description',true),'Project.description');?> |
      <?php echo $this->MyPaginator->sort(__('Created',true),'Project.creation');?>
    </div>
    <ul>
<?php
  $i = 0; $max = count($projects); $class='';
  $options['model'] = 'Project';
  $options['tag'] = 'span';
  foreach ($projects as $project):
    $options['id'] = $project['Project']['id'];
?>
      <li>
        <a href='home' class='read'>
        <?php echo $html->image('icons/XL/appeals.png', array('alt' => $project['Project']['description']))."\n"; ?>
        <span><?php echo $project['Project']['name']; ?></span>
        </a>
<?php echo $this->element($urlBase.DS.'favorites', $options); ?>
<?php //echo $this->element($urlBase.DS.'select', $options); ?>
<?php //echo $this->element('actions' . DS . 'action_row',$options); ?>
      </li>
<?php endforeach; ?>
    </ul>
  </div>
<?php echo $this->element($urlBase.'paging'); ?>
<?php endif; ?>
<?php echo $this->element($urlBase.'content_footer'); ?>
