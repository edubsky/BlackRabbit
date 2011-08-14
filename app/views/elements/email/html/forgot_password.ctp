<?php
/**
 * Passsword recovery email, html version
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.emails.html.forgot_password
 */
?>
<p><?php echo sprintf(__('Hello %s',true), ucfirst($user['Person']['firstname'])); ?>,</p>
<p><?php echo __('In order to reset your password please follow the link below'); ?>:</p>
<p><?php echo $html->link(
      Router::url('/',true).'password'.DS.'reset'.DS.$user['User']['key'],
      array('controller'=>'password','action'=>'reset',$user['User']['key'])
    ); ?></p>
<p><?php echo __('If you did not request this password recovery, please disregard this message.'); ?></p>
<?php echo $this->element('email'.DS.'html'.DS.'signature'); ?>
