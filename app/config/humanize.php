<?php
$config = array(
  'App.humanize' => array(
    // Internationalized objects names
    'objects' => array(
      'Project'  => __('Project',true),
      'Projects' => __('Projects',true),
      'User'     => __('User',true),
      'Users'    => __('Users',true)
    ),
    // Internationalized action names
    'actions' => array(
      // Generics / short version
      '*:add'         => __('Add', true),
      '*:edit'        => __('Edit', true),
      '*:delete'      => __('Delete', true),
      '*:save'        => __('Save', true),
      '*:archive'     => __('Archive', true),
      '*:restore'     => __('Restore', true),
      '*:cancel'      => __('Cancel', true),
      '*:update'      => __('Update', true),
      '*:import'      => __('Import', true),
      '*:export'      => __('Export', true),
      // Specialization / Redefinition
      'pages:home'    => __('Home', true),
      'projects:index'=> __('Project index', true),
      'projects:add'  => __('New project', true),
      'projects:edit' => __('Edit project', true),
      'users:forgot_password' => __('Lost password?', true),
    )
  )
);
?>
