<?php
/**
 * My Widget Helper
 * Widgets are tiny view elements with generic dynamic 
 * behaviour such as open / close, etc.
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.helpers.widget
 */
class WidgetsHelper extends Helper {
  var $helpers = array('Html','DisplaySettings');

  function header($id,$name,$options) {
?>
  <div class="widget">
    <div class="widget_header">
      <h3>
        <a href="<?php echo Router::url(); ?>" class="toggle open with_icon <?php echo $id; ?>" id="<?php echo $id; ?>">
          <span><?php echo $name; ?></span>
        </a>
      </h3>
    </div>
    <div class="widget_content toggle_wrapper_<?php echo $id; ?>">
<?php
  }

  function footer() {
?>
    </div>
  </div>
<?
  }
}//_EOF
?>
