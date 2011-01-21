<?php
/**
 * Add/Edit a project form view
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.projects.add > edit
 */
  $title_for_layout = ($this->action == 'add') ?
    __('Add a project',true) :
    __('Edit project',true).': '.$this->data['Project']['name'];
  $this->set('title_for_layout', $title_for_layout);
  $urlBase = 'content'.DS;
?>
<?php echo $this->element($urlBase.'content_header'); ?>
  <?php echo $this->MyForm->create('Project'); ?>
    <fieldset>
      <legend><?php echo __('Project\'s details',true); ?></legend>
      <?php
        echo $this->MyForm->input('name', array(
          'label' => __('Name',true),
          'class' => 'required',
          'error' => array(
            'notempty' => __('Sorry you can\'t have a project with no name!',true)
          )
        ));
      ?>
      <p class='example'><strong><?php echo __('Example',true);?>:</strong> <?php echo __('white rabbit project'); ?></p>
      <?php echo $this->MyForm->input('description'); ?>
      <?php echo $this->MyForm->input('archived'); ?>
      <?php echo $this->MyForm->input('completed'); ?>
    </fieldset>
    <?php echo $this->MyForm->cancel(); ?>
    <?php echo $this->MyForm->submit(__('save', true).' »'); ?>
  <?php echo $this->MyForm->end(); ?>
<?php echo $this->element($urlBase.'content_footer'); ?>
