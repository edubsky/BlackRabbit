<?php
/**
 * JS Meta include element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.js_includes.ctp
 */
// helper is required
if(!isset($javascript)) return;

// Must be enabled application & user wise
if(!Configure::read('App.gui.javascript.enabled')) return;
if(!User::get('Preference.gui.javascript.enabled')) return;

// load the javascript inclusion rules
Configure::load('includes' . DS . 'js');

// define the context
$controller = @Inflector::camelize(@$this->params['controller']);
$action = @$this->params['action'];
$alljs = Configure::read('JsIncludes');
$jsInclude = array();

// Define JS to be included
// Based on context and includes rules
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
