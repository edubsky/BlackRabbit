<?php
/* AuthKeys Test cases generated on: 2011-01-12 18:01:56 : 1294854296*/
App::import('Controller', 'AuthKeys');

class TestAuthKeysController extends AuthKeysController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AuthKeysControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.auth_key', 'app.user', 'app.person', 'app.office', 'app.role', 'app.preference', 'app.address', 'app.city', 'app.state', 'app.country');

	function startTest() {
		$this->AuthKeys =& new TestAuthKeysController();
		$this->AuthKeys->constructClasses();
	}

	function endTest() {
		unset($this->AuthKeys);
		ClassRegistry::flush();
	}

}
?>