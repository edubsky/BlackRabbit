<?php
/**
 * CSS Meta include element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.css_includes.ctp
 */
Configure::load('includes' . DS . 'css'); // css inclusion rules

$controller = @Inflector::camelize(@$this->params['controller']);
$action = @$this->params['action'];
$allcss = Configure::read('CssIncludes');
$cssIncludes = array();

// Define css to be included
// Based on config and includes rules
foreach ($allcss as $name => $include) {
  if (Common::requestAllowed($controller, $action, $include['rules'])) {
    unset($include['rules']);
    $media = isset($include['media']) ? $include['media'] : 'screen';
    $cssIncludes[$media][$name] = $include;
  }
}
/*
// Based on file presences (as in controller_action.css)
$viewFile = CSS . 'views' . DS . $controller . DS . $action . '.css';
if (file_exists($viewFile)) {
  $cssIncludes[] = 'views/' . $controller . '/' . $action . '.css';
}
*/
// If development or css compilation disabled
// Just embed css file independently
if (Common::isDevelopment() || Configure::read('App.css.compile')) {
  foreach ($cssIncludes as $media => $cssIncludes2) {
    foreach ($cssIncludes2 as $name => $include) {
      echo '  ' . $html->css($name,null,$include) . "\n";
    }
  }
  return;
} else {
  // Set the directory for the aggregates
  // based on the git version reset when changes
  $gitVersion = Common::GitVersion();
  if (!is_dir(CSS . 'aggregate' . DS . $gitVersion)) {
    Common::deleteFilesInDir(CSS . 'aggregate', '.*');
    @mkdir(CSS . 'aggregate' . DS . $gitVersion);
    @chmod(CSS . 'aggregate' . DS . $gitVersion, 0775);
  }

  // Create one file aggregating all css content
  // per medium (screen, print, etc.)
  foreach ($cssIncludes as $media => $cssInlcudes2) {
    $fileName = $gitVersion;
    $content  = '';

    // get the content and the aggregate file name
    foreach ($cssInlcudes2 as $CssName => $include) {
      $fileName .= $name;
      $content .= file_get_contents(CSS . $CssName);
      $content  = str_replace('(../img/', '(../../../img/', $content);
      // @TODO Additional clean up:
      // strip out comments
      //  $content = preg_replace('/((\/\*\n)+((.)*|(\n)+)+(\*\/)+)/Um','', $content);
      //  $content = preg_replace('/(}(\n)+\/)/Um',"}\n/", $content);
      // @TODO border radius compatibility
      // The css file can use the css3 selector directly and it get replace, as in:
      //   border-radius -> -moz-border-radius & -webkit-border-radius + IE Js fix
      //   border-top-right-radius, border-bottom-right-radius
      //   border-bottom-left-radius, border-top-left-radius,
      $content .= "\r\n";
    }
    $fileName = 'aggregate' . DS . $gitVersion . DS . md5($content.$media) . '.css';

    // create the file
    if (!file_exists(CSS . $fileName)) {
      fopen(CSS . $fileName, 'w+');
      file_put_contents(CSS . $fileName, $content);
    }

    // display the css tag
    echo '  '.$html->css(str_replace('.css', '', $fileName),null,array('media' => $media)) . "\n";
  }
}//_EOF
?>
