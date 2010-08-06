<?php
/* Projects Test cases generated on: 2010-04-28 16:04:46 : 1272463366*/
App::import('Controller', 'Projects');

class TestProjectsController extends ProjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.project');

	function startTest() {
		$this->Projects =& new TestProjectsController();
		$this->Projects->constructClasses();
	}

	function endTest() {
		unset($this->Projects);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>