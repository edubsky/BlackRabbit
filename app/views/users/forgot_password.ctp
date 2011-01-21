<?php
/**
 * Password recovery form view
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.users.forgot_password
 */
  $title_for_layout = __('Forgot your password?',true);
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
      <?php echo $this->MyForm->create('User', array('action' => 'forgot_password'))."\n"; ?>
      <fieldset>
        <legend><?php echo __('Please enter your email address'); ?></legend>
        <?php echo $this->MyForm->input('username', array(
          'class' => 'required',
          'label' => __('Username (email)',true),
          'tabindex' => ++$tabindex,
          /* Paranoia inside
           'error' => array(
            'valid' => __('This is not a valid email address',true)
           )*/
        ));?>
      </fieldset>
      <?php echo $this->MyForm->submit(__('recover password',true).' »', array(
         'label' => __('recover password',true).' »',
         'tabindex' => ++$tabindex
       )); ?>
    <?php echo $this->MyForm->end(); ?>
    </div>
  </div>
