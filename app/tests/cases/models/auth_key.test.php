<?php
/* AuthKey Test cases generated on: 2011-01-12 18:01:09 : 1294854009*/
App::import('Model', 'AuthKey');

class AuthKeyTestCase extends CakeTestCase {
	var $fixtures = array('app.auth_key');

	function startTest() {
		$this->AuthKey =& ClassRegistry::init('AuthKey');
	}

	function endTest() {
		unset($this->AuthKey);
		ClassRegistry::flush();
	}

}
?>