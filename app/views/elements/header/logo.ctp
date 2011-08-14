<?php
/**
 * Header element: logo
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.header.logo
 */
?>
  <h1>
    <a href="<?php echo Router::url('/'); ?>" class='logo'>
      <span><?php echo Configure::Read('App.name'); ?></span>
    </a>
  </h1>
