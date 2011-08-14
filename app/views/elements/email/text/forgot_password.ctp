<?php
/**
 * Passsword recovery email, text version
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.emails.text.forgot_password
 */
?>
<?php echo sprintf(__('Hello %s',true), ucfirst($user['Person']['firstname'])); ?>,

<?php echo __('In order to reset your password please follow the link below'); ?>:
<?php echo Router::url('/',true).'password'.DS.'reset'.DS.$user['User']['key']; ?>

<?php echo __('If you did not request this password recovery, please disregard this message.'); ?>

<?php echo $this->element('email'.DS.'text'.DS.'signature'); ?>
