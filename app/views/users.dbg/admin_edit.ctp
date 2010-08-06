<div class="content edit" id="users_edit">
	<?php
	if (User::is('root')) {
		echo $this->element('nav', array(
			'type' => 'admin_root_admin_sub', 'class' => 'menu with_tabs', 'div' => 'menu_wrapper'
		));
	} else {
		echo $this->element('nav', array(
			'type' => 'admin_config_sub', 'class' => 'menu with_tabs', 'div' => 'menu_wrapper'
		));
	}
	?>
	<?php echo $form->create('User');?>
	<?php if ($action == 'add') : ?>
		<p><?php echo __('A password will be autogenerated for this user and she will get an email with her login credentials.', true); ?></p>
	<?php endif; ?>
	<?php
	echo $form->input('id');
	echo $form->input('Contact.salutation', array('options' => Configure::read('App.contact.salutations')));
	echo $form->input('Contact.fname', array('label' => 'First Name'));
	echo $form->input('Contact.lname', array('label' => 'Last Name'));
	echo $form->input('login');

	$canEdit = $action == 'add' || $user['Role']['name'] != 'office_manager';
	if ($canEdit) {
		foreach ($roleOptions as $key => $value) {
			$roleOptions[$key] = Inflector::humanize($value);
		}
		echo $form->input('role_id', array('options' => $roleOptions));
		if (!empty($officeOptions)) {
			echo $form->input('office_id', array('options' => $officeOptions));
		}
	} else {
		echo '<p>' . __('You are not allowed to change the role or office of this user, as he is an office manager.', true) . '</p>';
	}
	echo '<h3>Individual Permissions</h3>';

	$isRoot = isset($user) && isset($user['Role']) && $user['Role']['name'] == 'root';
	if ($canEdit && !$isRoot) {
		$permissions = Configure::read('App.permissions.options');

		foreach ($permissions as $perm) {
			$perm = trim($perm);
			$permData = explode(':', $perm);
			$controller = $permData[0];
			$kAction = $permData[1];

			$label = $controller . ' ' . Inflector::humanize($kAction);
			$checked = true;
			if ($action == 'edit') {
				$checked = Common::requestAllowed($controller, $kAction, $user['Role']['permissions'], true);
				$checked = $checked && Common::requestAllowed($controller, $kAction, $user['User']['permissions'], true);
			}
			echo $form->input('permissions.' . $perm, array(
				'label' => $label,
				'type' => 'checkbox', 'value' => '',
				'checked' => $checked ? 'checked' : ''
			));
		}
	}
	
	if (!$canEdit) {
		echo '<p>' . __('You are not allowed to change the permissions of this user, as he is an office manager.', true) . '</p>';
	}

	if ($isRoot) {
		echo '<p>' . __('You are not allowed to change the permissions of this user, as he is a root user.', true) . '</p>';
	}
	echo $form->end('Save');
	?>
</div>