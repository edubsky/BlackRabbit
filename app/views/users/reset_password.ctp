<?php
/**
 * Password reset form view
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.users.reset_password
 */
  $title_for_layout = __('Reset your password',true);
  $this->set('title_for_layout',$title_for_layout);
  $tabindex = 0;
?>
  <h2><?php echo $title_for_layout ?></h2>
<?php echo $this->element('navigation', array(
        'id' => 'sub.authentication',
        'options'=> array('class'=>'menu with_tabs top')
)); ?>
  <div class="form_wrapper">
    <div class="form_wrapper2">
      <?php echo $this->MyForm->create('User', array(
        'url' => DS.'password'.DS.'reset'.DS.$token))."\n"; ?>
      <fieldset>
        <legend><?php echo __('Please enter your new password'); ?></legend>
        <?php echo $this->MyForm->input('password', array(
          'type' => 'password',
          'class' => 'required',
          'label' => __('Password',true),
          'tabindex' => ++$tabindex,
          'error' => array(
            'length' => __('The password should be between 5 and 50 caracter in length',true),
            'confirmed' => __('The passwords don\'t match',true)
          )
        ));?>
        <?php echo $this->MyForm->input('password_again', array(
          'type' => 'password',
          'value' => '',
          'class' => 'required',
          'label' => __('Password (again)',true),
          'tabindex' => ++$tabindex,
        ));?>
      </fieldset>
      <?php echo $this->MyForm->submit(__('change password',true).' »', array(
         'tabindex' => ++$tabindex
       )); ?>
    <?php echo $this->MyForm->end(); ?>
    </div>
  </div>
