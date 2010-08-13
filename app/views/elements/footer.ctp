<?php
/**
 * Footer element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.footer.ctp
 */
?>
<div id="footer">
  <p class="copyright"><strong><?php e(Configure::read('App.copyright'));?></strong>&nbsp;&nbsp;&#149;</p>
  <p class="version"><?php e(Configure::read('App.version.number')); e(' '.Configure::read('App.version.name'));?></p>
</div>
