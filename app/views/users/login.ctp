<?php
/**
 * Login View
 *  
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.users.login.ctp
 */
  $title_for_layout = __('Admin Login',true);
  $this->set('title_for_layout',$title_for_layout); 
  $tabindex = 0;
?>
  <h2><?php echo $title_for_layout ?></h2>
<?php echo $this->element('navigation', array('id' => 'authentication')); ?>
  <?php echo $this->MyForm->create('User', array('action' => 'login'))."\n"; ?>
<?php if ($session->check('Message.auth')): ?>
    <p class="error"><strong><?php echo __('Error',true); ?></strong>: <?php echo $session->read('Message.auth.message'); ?></p>
<?php endif; ?>
    <fieldset>
      <legend><?php echo __('Please enter your credentials'); ?></legend>
      <?php echo $this->MyForm->input('username', array(
        'class' => 'required',
        'label' => __('Username (email)',true),
        'tabindex' => ++$tabindex
      ));?>
      <?php echo $this->MyForm->input('password', array(
        'class' => 'required',
        'label' => __('Password',true),
        'tabindex' => ++$tabindex
      ));?>
      <?php /* echo $form->input('projects_list', array(
        'label'=> __('Project',true).$common->required(),
        'tabindex' => 3,
        'type'=>'select',
        'options' => $project_list
      ))."\n"; */?>
    </fieldset>
    <?php echo $this->MyForm->submit('login »', array(
       'text' => __('Logisn',true)."»",
       'tabindex' => ++$tabindex
     )); ?>
  <?php echo $this->MyForm->end(); ?>
