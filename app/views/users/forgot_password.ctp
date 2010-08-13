<?php
/**
 * Password recovery form view
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.users.forgot_password.ctp
 */
  $title_for_layout = __('Forgot your password?',true);
  $this->set('title_for_layout',$title_for_layout);
  $tabindex = 0;
?>
  <h2><?php echo $title_for_layout ?></h2>
<?php echo $this->element('navigation', array('id' => 'sub.authentication')); ?>
  <div class="form_wrapper"><div class="form_wrapper2">
  <?php echo $this->MyForm->create('User', array('action' => 'forgot_password'))."\n"; ?>
<?php if ($session->check('Message.auth')): ?>
    <p class="error"><strong><?php echo __('Error',true); ?></strong>: <?php echo $session->read('Message.auth.message'); ?></p>
<?php endif; ?>
    <fieldset>
      <legend><?php echo __('Please enter your email'); ?></legend>
      <?php echo $this->MyForm->input('username', array(
        'class' => 'required',
        'label' => __('Username (email)',true),
        'tabindex' => ++$tabindex
      ));?>
    </fieldset>
    <?php echo $this->MyForm->submit('login', array(
       'label' => __('Login',true),
       'tabindex' => ++$tabindex
     )); ?>
  <?php echo $this->MyForm->end(); ?>
  </div></div>