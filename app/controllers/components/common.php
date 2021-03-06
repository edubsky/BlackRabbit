<?php
/**
 * Common Component
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.common
 *
 * This class serves as a namespace for functions that need to
 * be globally available (statically mostly) within this application.
 */
class Common extends Object {

  /**
   * Check if application cookie is set
   * @param boolean $warn display warning message
   * @return void
   * @access public
   */
  function isCookieSet($warn=true) {
    if (!isset($_COOKIE[Configure::read('Session.cookie')])) {
      if($warn) {
        //TODO add javascript / css trick
        $this->Controller->Message->warning(
          'WARNING_COOKIES_MUST_BE_ENABLED',
          __('Cookies must be enabled past this point.',true)
        );
      }
      return false;
    }
    return true;
  }

  /**
   * Instanciate and return the reference to a model object
   * @param string name $model
   * @return model $ModelObj
   */
  static function &getModel($model,$create=false) {
    if (ClassRegistry::isKeySet($model) && !$create) {
      $ModelObj =& ClassRegistry::getObject($model);
    } else {
      $ModelObj =& ClassRegistry::init($model);
    }
    return $ModelObj;
  }

  /**
   * Instanciate and return the reference to a component object
   * @param string name $component
   * @return model $component
   */
  static function &getComponent($component) {
    $componentKey = 'Component.'.$component;
    $Component = null;
    if (ClassRegistry::isKeySet($componentKey)) {
      $Component =& ClassRegistry::getObject($componentKey);
    } else {
      if(App::import('Component', $component)) {
        $class = $component . 'Component';
        $Component = new $class;
        $Controller = new Controller();
        if (method_exists($Component, 'initialize')) {
          $Component->initialize($Controller, array());
        }
        if (method_exists($Component, 'startup')) {
          $Component->startup($Controller);
        }
      }
    }
    return $Component;
  }

  /**
   * Works just like php's date() function, but $now will default
   * to UTC+0 time instead of the servers
   * @todo user pref if available
   *
   * @param unknown $format
   * @param unknown $now
   * @return void
   * @access public
   *
  function utcDate($format, $now = null) {
    Common::defaultTo($now, Common::utcTime(), null);
    return date($format, $now);
  }

  /**
   * undocumented function
   *
   * @return void
   * @access public
   *
  function utcTime() {
    return strtotime(gmdate('Y-m-d H:i:s'));
  }
  */
  /**
   * undocumented function
   *
   * @param unknown $object
   * @param unknown $property
   * @param unknown $rules
   * @param unknown $default
   * @return void
   * @access public
   */
  function requestAllowed($object, $property, $rules, $default = false) {
    $allowed = $default;

    preg_match_all(
      '/\s?([^:,]+):([^,:]+)/is',$rules, $matches,PREG_SET_ORDER
    );

    foreach ($matches as $match) {
      list($rawMatch, $allowedObject, $allowedProperty) = $match;
      $rawMatch = trim($rawMatch);
      $allowedObject = trim($allowedObject);
      $allowedProperty = trim($allowedProperty);
      $allowedObject = str_replace('*', '.*', $allowedObject);
      $allowedProperty = str_replace('*', '.*', $allowedProperty);

      $negativeCondition = false;
      if (substr($allowedObject, 0, 1) == '!') {
        $allowedObject = substr($allowedObject, 1);
        $negativeCondition = true;
      }

      if (preg_match('/^'.$allowedObject.'$/i', $object) && preg_match('/^'.$allowedProperty.'$/i', $property)) {
        $allowed = !$negativeCondition;
      }
    }
    return $allowed;
  }

  /**
   * Return the id of the head of the master branch (version number)
   * This id is used to detect if cache should be purged for CSS caching
   * @return md5 hash
   */
  static function gitVersion() {
    static $version = null;
    if (!is_null($version)) {
      return $version;
    }

    $versFile = ROOT. DS . '.git' . DS . 'refs' . DS . 'heads' . DS . 'master';
    if (!file_exists($versFile)) {
      return -1;
    }

    preg_match('/^[a-z0-9]+/', file_get_contents($versFile), $match);
    return $match[0];
  }

  /**
   * Indicates if a given string is a UUID
   * @param string $str
   * @return boolean
   */
  static function isUuid($str) {
    return is_string($str) && preg_match('/^[A-Fa-f0-9]{8}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{4}-[A-Fa-f0-9]{12}$/', $str);
  }

  /**
   * Return a UUID - ref. String::uuid();
   * @return uuid
   */
  static function uuid($seed=null){
    return String::uuid();
  }

  /**
   * Delete files in a given directory
   *
   * @param string $path
   * @param string $pattern
   * @return void
   * @access public
   */
  function deleteFiles($path, $pattern = '.*') {
    $pattern = '/'.$pattern.'/';
    $deletedOne = false;
    if ($handle = opendir($path)) {
      while (false !== ($file = readdir($handle))) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        if (preg_match($pattern, $file)) {
          @unlink($path . DS . $file);
          $deletedOne = true;
        }
      }
      closedir($handle);
    }
    return $deletedOne;
  }

  /**
   * undocumented function
   *
   * @param string $length
   * @param string $whitelist
   * @return void
   * @access public
   */
  static function randomString($length = 6, $whitelist = array()) {
    if ($length < 1) {
      trigger_error('Common::randomString() may not be called with a length < 1');
    }
    if (empty($whitelist)) {
      $whitelist = range(0, 9);
    }
    $result = '';
    for ($i = 0; $i < $length; $i++) {
      shuffle($whitelist);
      $result .= $whitelist[0];
    }
    return $result;
  }
}//_EOF
