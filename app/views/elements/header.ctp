<?php
/**
 * Body header element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.header.ctp
 */
 $urlBase = 'header' . DS ;
?>
  <h1>
    <a href="<?php echo Router::url('/home'); ?>" class='logo'>
      <span><?php echo Configure::Read('App.name'); ?></span>
    </a>
  </h1>
<?php //echo $this->element($urlBase.'projects_selector'); ?>
<?php echo $this->element($urlBase.'user_badge'); ?>
