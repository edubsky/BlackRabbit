<?php
/**
 * JS Meta include element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.js_includes.ctp
 */
if(!isset($javascript)) return; // helper required

// The context
$controller = @Inflector::camelize(@$this->params['controller']);
$action = @$this->params['action'];
$alljs = Configure::read('JsIncludes');
$jsInclude = array();

// Define JS to be included
// Based on config and includes rules
foreach ($alljs as $name => $include) {
  if (Common::requestAllowed($controller, $action, $include['rules'])) {
    unset($include['rules']);
    $jsInclude[] = $name;
  }
}

/**
 * TODO: Compile and minimize!
 */
// Display the file
foreach ($jsInclude as $include) {
  echo '  '.$javascript->link($include)."\n";
}

/**
 * JSON Variables
 */
if (isset($jsonVars)):
?>
  <script type="text/javascript">
  //<![CDATA[
    window.jsonVars = <?php echo $javascript->object($jsonVars); ?>;
  //]]>
  </script>
<?php
endif;
?>