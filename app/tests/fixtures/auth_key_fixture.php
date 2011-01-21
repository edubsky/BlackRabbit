<?php
/* AuthKey Fixture generated on: 2011-01-12 18:01:09 : 1294854009 */
class AuthKeyFixture extends CakeTestFixture {
	var $name = 'AuthKey';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'foreign_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'expires' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_key' => array('column' => 'key', 'unique' => 1), 'one_key_per_type' => array('column' => array('user_id', 'auth_key_type'), 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '4d2de779-9224-4c0a-ae66-14ffae790e16',
			'user_id' => 'Lorem ipsum dolor sit amet',
			'key' => 'Lorem ipsum dolor sit amet',
			'foreign_id' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-01-12 18:40:09',
			'expires' => '2011-01-12 18:40:09'
		),
	);
}
?>