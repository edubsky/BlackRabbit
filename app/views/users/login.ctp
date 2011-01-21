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
<?php echo $this->element('navigation', array(
	'id' => 'sub.authentication',
	'options'=> array('class'=>'top menu with_tabs')
)); ?>
  <div class="form_wrapper">
    <div class="form_wrapper2">
      <?php echo $this->MyForm->create('User', array('action' => 'login'))."\n"; ?>
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
        </fieldset>
        <?php echo $this->MyForm->submit(__('login',true).' »', array(
           'tabindex' => ++$tabindex
         )); ?>
      <?php echo $this->MyForm->end(); ?>
    </div>
  </div>
