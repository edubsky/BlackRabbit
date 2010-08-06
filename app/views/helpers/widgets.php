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
   <div class="favorites widget open">
    <div class="widget_header">
      <h3>
        <a href="<?php echo Router::url(); ?>" class="toggle open" id="<?php echo $id; ?>">
          <?php echo $name; ?>
        </a>
      </h3>
    </div>
    <div class="widget_content">
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