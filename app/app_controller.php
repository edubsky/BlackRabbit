<?php
/**
 * Application Controller
 * All other controllers extend from it
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.app_controller
 */
App::import('Model', array('User'));
//App::import('Core', 'Controller');
class AppController extends Controller {
  /**
   * @var array $components, controller components
   */
  var $components = array(
    'RequestHandler','Cookie','Session',      // default
    'Mailer',//'Json', // 'Ssl','Pgp','Json',
    'Auth',                                   // redefined
    'Log','Message','DisplaySettings'         // custom
  );

  /**
   * @var array $plugins
   *
  var $plugins = array(
    //'Comments'
    //'Bugs','Tellfriends','Logging','Chat',
    //'Smileys','Segments','Filters',
  );
  */

  /**
   * @var array $helpers, helpers for the view
   */
  var $helpers = array(
    'Html','Form','Paginator','Session',   // default
    'Javascript',
    'MyHtml','MyPaginator','MyForm',       // redefinitions
    'DisplaySettings',                     // custom
    'Navigation','Actions', 'Sidebar',
    'Favorites','Widgets'
  );

  /**
   * Before Filter hoock
   * @return void
   */
  function beforeFilter(){
    $this->Auth->filterAccess();
  }

  /**
   * Common index page behaviors
   * Allow enabling several view types (icon, list, etc.)

  function index() {
    // view mode
    $viewMode = $this->getViewMode();
    if($viewMode) {
      $this->action = 'index_'.$viewMode;
    }
  }
   */

  /**
   * Before render callback
   * @see controller::beforeRender
   * @return void
   */
  function beforeRender() {
    if($this->name == 'CakeError') {
      $this->layout = 'error';
    }
    $this->Log->log();
    parent::beforeRender();
  }
}//_EOF
