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
</head>
<body>
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
<?php //pr(User::get()); ?>
<?php //pr($this); ?>
</body>
</html>
