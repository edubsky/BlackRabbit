<?php
/**
 * Passsword recovery email, html version
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.emails.html.forgot_password
 */
?>
<p>Hello <?php echo ucfirst($user['Person']['firstname']); ?></p>
<p>In order to reset your password please follow the link below:</p>

<p>If you did not request this password recovery, please disregard this message.</p>
<?php echo $this->element('email'.DS.'html'.DS.'signature'); ?>
