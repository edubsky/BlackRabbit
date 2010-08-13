<?php
/**
 * Message display
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.messages.ctp
 */
 $message_style = $this->DisplaySettings->getMessageStyle(); // dialog box, or inline on top of the screen
 $use_icon = isset($use_icon) ? $use_icon : $this->DisplaySettings->useIcons();
?>
<?php if (!isset($flashMessages) || empty($flashMessages)): ?>
<div class="messages empty"></div>
<?php else : ?>
<div class="messages_wrapper">
  <ul class="messages ">
<?php foreach ($flashMessages as $message): $id = Common::uuid(); ?>
    <li class="message <?php e($message['type']); ?> <?php e($message_style); ?> toggle_wrapper_<?php e($id); ?>">
      <a href='<?php echo Router::url(); ?>' class='close <?php e($use_icon); ?> toggle' id='<?php e($id);?>'><span><?php echo __('close',true); ?></span></a>
      <h3><?php echo $message['title']; ?></h3>
      <p><?php echo $message['text']; ?></p>
    </li>
<?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
