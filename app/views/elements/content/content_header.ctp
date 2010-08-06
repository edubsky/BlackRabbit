<?php 
/**
 * Content Header Element
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.content_header.ctp
 * 
 * An element included at the top of all views, used to display title,
 * breadcrumb, etc. and ease maintenance
 */
 $urlBase = 'content' . DS;
 if(!isset($navigation_options)) {
   $navigation_options = array(
     'id' => 'sub.'.$this->params['controller'] . ':' . $this->params['action']
   );
 }
?>
  <h2><?php echo $title_for_layout; ?></h2>
<?php //echo $this->element('breadcrumb'); ?>
<?php if($this->params['action']=='index') echo $this->element($urlBase.'display_selector'); ?>
<?php if(isset($navigation_options)) echo $this->element('navigation',$navigation_options); ?>
<?php echo $this->element('actions' . DS . 'action_bar'); ?>
