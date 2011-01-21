<?php
/**
 * Passsword recovery email, text version
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.emails.text.forgot_password
 */
?>
Hello <?php echo ucfirst($user['Person']['firstname']); ?>,

In order to reset your password please follow the link below:
<?php //echo $auth['reset_link']; ?>

If you did not request this password recovery, please disregard this message.

<?php echo $this->element('email'.DS.'text'.DS.'signature'); ?>
