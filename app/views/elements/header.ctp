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
<?php echo $this->element($urlBase.'logo'); ?>
<?php //echo $this->element($urlBase.'projects_selector'); ?>
<?php echo $this->element($urlBase.'user_badge'); ?>
