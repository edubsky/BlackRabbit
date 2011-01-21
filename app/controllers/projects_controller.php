<?php
/**
 * Projects controller
 * A controller to manage projects
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.projects
 */
class ProjectsController extends AppController {
  var $name = 'Projects'; /// @var controller name

  /**
   * Project Index
   * @param $type string (archived, all, etc.)
   * @return void
   * @access public
   */
  function index($type=null) {
    $this->Project->recursive = 0;
    switch($type){
      case 'archived':
        $conditions = array('archived' =>'1');
      break;
      case 'all': default:
        $conditions = array('archived'=>'0');
      break;
    }
    $this->paginate = array(
      'conditions' => $conditions,
      'contain' => array(
        'Favorite(id,user_id,model,created)',
      ),
      'fields' => array(
        'id','name','description','created'
      )
    );
    $this->set('projects', $this->paginate());

    // view mode
    $viewMode = $this->DisplaySettings->getViewMode();
    if($viewMode) {
      $this->render('index_'.$viewMode);
    }

  //  pr(User::get());
  //  pr($this->Session->read());
  }

  /**
   * View a project
   * @param UUID $id
   */
  function view($id = null) {
    if (!empty($id) && Common::isUuid($id)) {
      $project = $this->Project->read(null, $id);
      if(!empty($project)) {
        $this->set('project', $this->Project->read(null, $id));
        return;
      }
    }
    $this->Message->error('INVALID_PROJECT_ID',
      __('Sorry, this project is invalid or have been deleted', true),
      array('action' => 'index')
    );
  }

  /**
   * Add a project
   * @return void
   * @access public
   */
  function add() {
    if (!empty($this->data)) {
      $this->Project->create();
      if ($this->Project->save($this->data)) {
        $this->Message->success(
          sprintf(__('The project was sucessfully saved (%)', true), $this->Project->id), 
          array('action'=>'index')
        );
      } else {
        $this->Message->error(
          sprintf(__('Oops, the project could not be saved (%)', true), $this->Project->id),
          array('action'=>'index')
        );
      }
    }
  }

  /**
   * Edit a given project
   * @param $id project uuid
   * @return void
   * @access public
   */
  function edit($id = null) {
    // some data where submited
    if (!empty($this->data)) {
      if ($this->Project->save($this->data)) {
        $this->Message->succes(
          sprintf(__('The project was sucessfully saved (%)', true), $this->Project->id),
          array('action'=>'index')
        );
      } else {
        $this->Message->error(
          sprintf(__('The project could not be saved, please correct the errors bellow (%)', true), $this->Project->id)
        );
      }
    }
    if (empty($this->data) && !empty($id) && Common::isUuid($id)) {
      $project = $this->Project->read(null, $id);
      if(!empty($project)) {
        $this->set('project', $this->Project->read(null, $id));
        return;
      }
    }
    $this->Message->error('INVALID_PROJECT_ID',
      __('Sorry, this project is invalid or have been deleted', true),
      array('action' => 'index')
    );
  }

  /**
   * Generic Archiving functionality
   */
  function archive($id){
    try {
      $sucess = $this->Project->archive($id);
    } catch (Exception $e) {
      $this->Message->error($e->getMessage().' ('.$id.')');
    }

    if($sucess) {
      $this->Message->notice(
        sprintf(__('The project was sucessfully archived (%s)',true),$id)'
      );
    } else {
      $this->Message->error(
        sprintf(__('Sorry but the project couldn\'t be updated  (%s)',true),$id)
      );
    }
  }

  /**
   * Generic Restore Archive functionality
   */
  function restore($id){
    try {
      $sucess = $this->Project->restore($id);
    } catch (Exception $e) {
      $this->Message->error($e->getMessage().' ('.$id.')');
    }

    if($sucess) {
      $this->Message->success(
        sprintf(__('The project was sucessfully restored (%s)',true),$id), 'notice'
      );
    } else {
      $this->Message->error(
        sprintf(__('Sorry but the project couldn\'t be restored (%s)',true),$id), 'error'
      );
    }
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
}//_EOF
