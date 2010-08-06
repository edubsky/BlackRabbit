<?php
/**
 * Meta elements
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.meta.ctp
 */
 $urlBase = 'meta'. DS ;
?>
  <base href='<?php echo r('www.', '', Router::url('/', true)); ?>'/>
<?php echo $this->element($urlBase . 'ascii_art'); ?>
<?php echo $this->element($urlBase . 'charset'); ?>
<?php echo $this->element($urlBase . 'copyright'); ?>
<?php echo $this->element($urlBase . 'description'); ?>
<?php echo $this->element($urlBase . 'keywords'); ?>
<?php echo $this->element($urlBase . 'icon'); ?>
<?php echo $this->element($urlBase . 'robots'); ?>
<?php echo $this->element($urlBase . 'css_includes');?>
<?php echo $this->element($urlBase . 'js_includes');?>
