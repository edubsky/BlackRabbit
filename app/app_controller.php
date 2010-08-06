<?php
/**
 * Application Controller
 * The default controller: all other controllers extend it
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.app_controller.php
 */
App::import('Model', array('User', 'Page'));
App::import('Core', 'Controller');
class AppController extends Controller {
  
  var $components = array(
    'RequestHandler', 'Cookie', 'Session', 'Auth',  // default
  	//'Email','Json', // 'Ssl','Pgp','Json',
    'Message'
  );

  var $plugins = array(
    'Comments'
    //'Bugs','Tellfriends','Logging','Chat',
    //'Smileys','Segments','Filters',
  );

  var $helpers = array(
    'Html','Form','Paginator','Session',   // default
    'Javascript',
    'MyHtml','MyPaginator','MyForm',       // redefinitions
    'Common', 'DisplaySettings',           // custom
    'Navigation','Actions', 'Sidebar',      
    'Favorites','Widgets'
  );

  /**
   * Before Filter hoock
   */
  function beforeFilter(){
    //echo "fuckaty"; die;
    
    // Authentication components config
    $this->Auth->autoRedirect = false;
    $this->Auth->userScope = array('User.active' => 1);

    if(User::get() != null && !User::isGuest()){
      // Project List is always usefull
      // @todo optimize for double call on projects::index ? (aaargh)
      // @todo only get the list at login / counter cache?
      
      $this->Project = ClassRegistry::init('Project');
  	  $project_list = $this->Project->find('list', array(
  	  	'fields' => array('name')
  	  ));
  	  $project_list['ADMIN_PANEL'] = __('Admin panel',true); // special section
  	  $this->set(compact('project_list'));
  	  
  	  // Load favorites list
  	  $this->Favorite = ClassRegistry::init('Favorite');
  	  $this->Favorite->load(User::get('id'));
  	  
  	  //Check access rights
  	  if(!User::isAllowed($this->name,$this->action)){
        $this->Message->add(
          sprintf(__('Sorry you are not allowed to access this resource (%s:%s)',true),
            $this->name,$this->action), 'error'
        );
      }
    }
  }

  /**
   * Before render hoock
   */
  function beforeRender(){
    if($this->name == 'CakeError' && !isset($this->Auth->user)) {
      $this->layout = 'login';
    }
    parent::beforeRender();
  }
}//_EOF
?>