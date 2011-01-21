<?php
/**
 * Footer element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.footer.ctp
 */
?>
<div class="footer_wrapper">
  <div class="footer">
    <p class="copyright"><strong><?php echo Configure::read('App.copyright');?></strong></p>
    <p class="version">&#149;&nbsp;<?php echo Configure::read('App.version.number').' '.Configure::read('App.version.name');?></p>
  </div>
</div>
