<?php
/**
 * History Sidebar Box
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.sidebar.favorites
 */
  $history = UserLog::get(5);
?>
<?php $widgets->header('history',__('History',true),array('toogle' => true)); ?>
<?php if(sizeof($history)): ?>
      <ul class="with_bullets">
<?php foreach($history as $i => $log) :
?>
        <li><?php
          $label = $log['UserLog']['resource'].' '.$log['UserLog']['action'].' ('.$log['UserLog']['created'].')';
          echo $this->MyHtml->link($label, array(
            'controller' => $log['UserLog']['resource'],
            'action' => $log['UserLog']['action'] . DS . $log['UserLog']['get_data_url'],
//            'action' => $log['UserLog']['action']. DS . $log['UserLog']['resource_id'];
          ));
          ?></li>
<?php endforeach; ?>
      </ul>
<?php else: ?>
      <p><?php echo __('You can add items to this favorite list by starring them.',true); ?></p>
<?php endif; ?>
<?php $widgets->footer(); ?>
