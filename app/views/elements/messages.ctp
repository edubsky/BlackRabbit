<?php
/**
 * Message display
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.messages.ctp
 */
 $message_style = 'dialog_box'; // dialog_box, or on top of the screen
 $use_icon = isset($use_icon) ? $use_icon : $this->DisplaySettings->useIcons();
?>
<?php if (!isset($flashMessages) || empty($flashMessages)): ?>
<div class="messages empty"></div>
<?php else : ?>
<div class="messages_wrapper">
  <ul class="messages <?php e($message_style); ?>">
<?php foreach ($flashMessages as $message): ?>
    <li class="message <?php echo $message['type']; ?>">
      <a href='<?php echo Router::url(); ?>' class='close <?php e($use_icon); ?>'><span><?php echo __('close',true); ?></span></a>
      <h3><?php echo $message['title']; ?></h3>
      <p><?php echo $message['text']; ?></p>
    </li>
<?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
