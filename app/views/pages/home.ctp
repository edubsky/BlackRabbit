<?php
	$actions = array();/*
		'test' => '/test',
		'test' => '/test',
	)*/
?>
  <h2><?php echo __('What do you feel like doing?'); ?></h2>
<?php if(isset($actions)):?>
<?php foreach($actions as $name => $url): ?>
  <li><a href='<?php echo $url; ?>'><?php echo $name; ?></a></li>
<?php endforeach; ?>
<?php endif; ?>
  <div class='view icon'>
    <ul>
      <li><?php echo $html->link( $html->image("icons/XL/help.png", array("alt"=>"help"))."Help me get started...",
	       array("admin"=>true,"controller"=>"help"), array('escape' => false)); ?></li>
      <li><?php echo $html->link( $html->image("icons/XL/appeals.png", array("alt"=>"appeals"))." Manage appeals",
           array("admin"=>true,"controller"=>"appeals", 'all'), array('escape' => false)); ?></li>
      <li><?php echo $html->link( $html->image("icons/XL/kexi.png", array("alt"=>"help"))."Browse Gifts",
           array("admin"=>true,"controller"=>"gifts", 'all'), array('escape' => false)); ?></li>
      <li><?php echo $html->link( $html->image("icons/XL/vcard.png", array("alt"=>"help"))."Browse Transactions",
            array("admin"=>true,"controller"=>"transactions", 'all'), array('escape' => false)); ?></li>
      <li><?php echo $html->link( $html->image("icons/XL/users.png", array("alt"=>"users"))." Manage Supporters",
            array("admin"=>true,"controller"=>"supporters"), array('escape' => false)); ?></li>
    </ul>
  </div>
