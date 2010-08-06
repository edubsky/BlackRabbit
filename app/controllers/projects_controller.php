<?php
/**
 * Projects controller
 * A controller to manage projects
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.projects
 */
class ProjectsController extends AppController {
  var $name = 'Projects';

  function index($type=null) {
    $this->Project->recursive = 0;
    switch($type){
      case 'archived':
        $conditions = 'archived=1'; 
      break;
      case 'all' :
      default: 
        $conditions = 'archived=0';  
      break;
    }
    
    $this->paginate = array(
      'conditions' => $conditions
    );
    $this->set('projects', $this->paginate());
  }
  
  /*
  function view($id = null) {
    if (!$id) {
	  $msg = 'There are problems with the form.';
	  $this->Message->add($msg, 'error');
      $this->redirect(array('action' => 'index'));
    }
    $this->set('project', $this->Project->read(null, $id));
  }
  */

  function add() {
    if (!empty($this->data)) {
      $this->Project->create();
      if ($this->Project->save($this->data)) {
        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'project'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'project'));
      }
    }
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(sprintf(__('Invalid %s', true), 'project'));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Project->save($this->data)) {
        $this->Session->setFlash(sprintf(__('The %s has been saved', true), 'project'));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'project'));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Project->read(null, $id);
    }
  }

  /**
   * Generic Archiving functionality
   */
  function archive($id=null){
    parent::archive($id);
  }

/*
  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'project'));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Project->delete($id)) {
      $this->Session->setFlash(sprintf(__('%s deleted', true), 'Project'));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Project'));
    $this->redirect(array('action' => 'index'));
  }
*/
}
?>