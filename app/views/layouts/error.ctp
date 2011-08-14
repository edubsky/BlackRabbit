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
  <title><?php echo sprintf(Configure::read('App.browserTitle'),_('Ooops, something is wrong')); ?></title>
  <style>
    body {
      background:#f0ebe2;
      font-family:verdana, arial, sans-serif;
    }
    #error {
      width:690px;
      margin:50px auto;
      background:#FFF;
      padding:20px 20px 50px 20px;
      border:1px solid #837663;
      -moz-border-radius:5px;
      -border-radius:5px;
    }
    #error h1 {
      font-size:18px;
      border-bottom:1px solid #837663;
      padding-bottom:10px;
    }
    #error ul li {
      padding-bottom:5px;
    }
  </style>
</head>
<body>
<div class="container" id="error">
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
<?php //pr(User::get()); ?>
<?php //pr($this); ?>
</div>
</body>
</html>
