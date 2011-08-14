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
  function index($type='all') {
    // get the results and paginate
    $this->paginate = Project::getFindOptions('index:'.$type);
    $this->set('projects', $this->paginate());

    // view mode
    $viewMode = $this->DisplaySettings->getViewMode();
    if($viewMode) {
      $this->render('index_'.$viewMode);
    }
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
    // if the project was not found
    $this->Message->error(
      'ERROR_INVALID_PROJECT_ID',
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
          sprintf(__('The project was sucessfully saved (%s)', true), $this->Project->id),
          array('action' => 'index')
        );
      } else {
        $this->Message->error(
          'ERROR_PROJECT_ADD_SAVE',
          __('Oops, the project could not be saved', true)
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
    $this->uuid['action'] = 'df8e4a16-8141-11e0-a245-000ae4cc0097';
    // some data where submited
    if (!empty($this->data)) {
      $this->Project->id = $id;
      if ($this->Project->save($this->data)) {
        $this->Message->success(
          sprintf(__('The project was sucessfully saved (%s)', true), $this->Project->id),
          array('action' => 'index')
        );
      } else {
        $this->Message->error(
          'ERROR_PROJECT_EDIT_SAVE',
          sprintf(__('The project could not be saved, please correct the errors bellow (%)', true), $this->Project->id)
        );
      }
    } else {
      $error = true;
      if (!empty($id) && Common::isUuid($id)) {
        $project = $this->Project->read(null, $id);
        if(!empty($project)) {
          $error = false;
          $this->data =  $project;
        }
      }
      if($error) {
        $this->Message->error(
          'ERROR_INVALID_PROJECT_ID',
          __('Sorry, this project is invalid or have been deleted', true),
          array('action' => 'index')
        );
      }
    }
  }

  /**
   * Generic Archiving functionality
   */
  function archive($id){
    $success = false;
    try {
      $success = $this->Project->archive($id);
    } catch (Exception $e) {
      $this->Message->error(
        'ERROR_PROJECT_ARCHIVE',
        $e->getMessage().' ('.$id.')', true
      );
    }
    if($success) {
      $this->Message->success(
        sprintf(__('The project was sucessfully archived (%s)',true),$id),
        true
      );
    } else {
      $this->Message->error(
        'ERROR_PROJECT_ARCHIVE',
        sprintf(__('Sorry but the project couldn\'t be archived (%s)',true),$id),
        true
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
       $this->Message->error(
         'ERROR_PROJECT_RESTORE',
         $e->getMessage().' ('.$id.')',
         true
       );
    }
    if($sucess) {
      $this->Message->success(
        sprintf(__('The project was sucessfully restored (%s)',true),$id), true
      );
    } else {
      $this->Message->error(
        'ERROR_PROJECT_RESTORE',
        sprintf(__('Sorry but the project couldn\'t be restored (%s)',true),$id), true
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
