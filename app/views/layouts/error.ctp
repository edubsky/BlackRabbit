<?php
/**
 * Error Layout
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.layout.error
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php echo sprintf(Configure::read('App.browserTitle'),$title_for_layout); ?></title>
<?php echo $this->element('meta'); ?>
</head>
<body>
<div id="container">
<?php echo $this->element('messages'); ?>
<!-- HEADER -->
<div id="header">
<?php echo $this->element('header'); ?>
<?php echo $this->element('navigation', array(
  'options' => array('id'=>'top_navigation'))); 
?>
</div>
<!-- CONTENT -->
<div class="content_wrapper with_<?php echo Configure::read('App.gui.sidebar.position'); ?>_sidebar">
<div class="content_wrapper2">
<div class="content">
<?php echo $content_for_layout; ?>
</div>
<!-- SIDEBAR -->
<div class="sidebar">
<?php echo $this->element('sidebar'); ?>
</div>
</div>
</div>
<!-- FOOTER -->
<?php echo $this->element('footer'); ?>
</div>
<?php echo $this->element('sql_dump'); ?>
<?php //pr(User::get()); ?>
<?php //pr($this); ?>
</body>
</html>
