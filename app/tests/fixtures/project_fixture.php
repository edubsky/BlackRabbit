<?php
/* Project Fixture generated on: 2010-04-28 16:04:27 : 1272463287 */
class ProjectFixture extends CakeTestFixture {
	var $name = 'Project';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'archived' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'completed' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '4bd83fb7-b8e4-4b8b-99ca-3284ae790e16',
			'name' => 'Lorem ipsum dolor sit amet',
			'archived' => 1,
			'completed' => 1,
			'created' => '2010-04-28 16:01:27'
		),
	);
}
?>