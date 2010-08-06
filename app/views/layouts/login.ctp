<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title><?php echo sprintf(Configure::read('App.browserTitle'),$title_for_layout); ?></title>
<?php echo $this->element("meta"); ?>
</head>
<body>
<div id="container">
<div id="header">
<?php echo $this->element('header'); ?>
</div>
<div id="content_wrapper">
<div class="content users login">
<?php echo $content_for_layout; ?>
</div>
<?php echo $this->element('sidebar'); ?>
</div>
<?php echo $this->element('footer'); ?>
</div>
<?php echo $this->element('sql_dump'); ?>
<?php //pr(User::get()); ?>
<?php //pr($this); ?>
</body>
</html>
