<?php
/**
 * Project Index View
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.projects.index_list
 */
  $title_for_layout = __('Project Index',true);
  $this->set('title_for_layout',$title_for_layout);
  $urlBase = 'content'.DS;
?>
<?php echo $this->element('content'.DS.'content_header'); ?>
<?php if(!count($projects)): ?>
  <p class='empty'><?php __('Sorry there is nothing to display here'); ?></p>
<?php else: ?>
  <?php echo $this->MyHtml->table(array('collumn_count' => 4)); ?>
    <thead>
    <tr>
<?php echo $this->element($urlBase.DS.'select'); ?>
<?php echo $this->element($urlBase.DS.'favorites'); ?>
      <th style="max-width:200px;min-width:150px;"><?php echo $this->MyPaginator->sort(__('Name',true),'Project.name');?></th>
      <th ><?php echo $this->MyPaginator->sort(__('Description',true),'Project.description');?></th>
      <th class="datetime"><?php echo $this->MyPaginator->sort(__('Created',true),'Project.created');?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
    </thead>
    <tbody>
<?php
  $i = 0; $max = count($projects); $class='';
  $options['model'] = 'Project';
  foreach ($projects as $project):
    if ($max > 2) $class = ($i++ % 2 == 0) ? 'altrow' : null ;
    $options['id'] = $project['Project']['id'];
    $options['selected'] = isset($project['Favorite']['id']) ? true : false;
?>
    <tr class='<?php echo $class;?>'>
<?php echo $this->element($urlBase.DS.'select'); ?>
<?php echo $this->element($urlBase.DS.'favorites', $options); ?>
      <td><?php echo $project['Project']['name']; ?>&nbsp;</td>
      <td><?php echo $project['Project']['description']; ?>&nbsp;</td>
      <td><?php echo $this->DisplaySettings->date($project['Project']['created']); ?>&nbsp;</td>
      <td class="actions">
<?php echo $this->element('actions' . DS . 'action_row',$options); ?>
      </td>
    </tr>
    </tbody>
<?php endforeach; ?>
  </table>
<?php echo $this->element($urlBase.'paging'); ?>
<?php endif; ?>
<?php echo $this->element($urlBase.'content_footer'); ?>
