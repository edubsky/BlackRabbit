<?php
/**
 * Display Settings Helper
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.helpers.view_mode
 */
class DisplaySettingsHelper extends Apphelper {
  var $helpers = array('Html');

  // default view mode options
  var $viewModeOptions;       // list of enabled view types
  var $__viewModeOptionsList; // temp var to store the view mode real names & help text
  var $_selectedDisplay;      // currently selected display mode (from available options)
  var $_baseUrl;              // url without display settings (for regeneration of url)

  /**
   * Before Render hook function
   * @see AppHelper::beforeRender
   */
  function beforeRender(){
    $this->__viewModeOptionsList = Configure::read('App.gui.viewModes.options');
    $this->viewModeOptions = array_keys($this->__viewModeOptionsList);
    // detect the current display settings based on parameters
    $this->_selectedDisplay = User::get('Preference.gui.viewModes.default');
    // strip down the current display settings (and extra slashes)
    $this->_baseurl = preg_replace('/\/\//','/',
      preg_replace('/'.Configure::read('App.gui.viewModes.urlName')
        .':('.implode("|", $this->viewModeOptions).')(\/){0,1}/','',Router::url().DS)
    );
  }

  /**
   * Generate a link for the display selector
   * @param $display
   * @param $options
   * @return string
   */
  function viewModelink($display=null,$options=array()){
    $defaults = array(
      'class'    => '',
      'span'     => true,
      'tooltip'  => User::get('Preference.gui.tooltip.enabled')
    );
    $options = array_merge($defaults,$options);
    $display = isset($display) ? $display : $this->_selectedDisplay;

    if (isset($this->__viewModeOptionsList[$display])) {
      $text = $this->__viewModeOptionsList[$display]['name'];
      $help = $this->__viewModeOptionsList[$display]['help'];
    } elseif (isset($this->viewModeOptions[$display])) {
      $text = $this->viewModeOptions[$display];
    } else return false;

    if($options['span']) // extra wrapper?
       $text = '<span>'.$text.'</span>';
    $results = '<a class=\''.$options['class'].' '.$display;
    if ($options['tooltip'] && isset($help)) // tooltips?
      $results.= ' minitooltip\' title=\''.$help;
    $results.= '\' '
      .'href=\''.$this->_baseurl.Configure::read('App.gui.viewModes.urlName').':'.$display.'\'>'
      .$text.'</a>';

    return $results;
  }

  /**
   * Indicates if a current display setting is in use
   * @param $display setting to be tested
   * @param $return return style (bool or string)
   * @return mixed bool true if $display is currently in use, string selected or ''
   */
  function isViewModeSelected($display,$return=null){
    $return = isset($return) ? $return : 'string';
    $result = ($this->_selectedDisplay == $display);
    switch ($return) {
      case 'string':
        return ($result ? 'selected' : '');
      break;
      default:
        return $result;
    }
  }

  /**
   * Should we use icons?
   * @param $return class string or bool
   * @param $override bool override config with given boolean
   * @return $result boolean
   */
  function useIcons($return='class',$override=null){
    //TODO test context & user pref
    $result = isset($override) ? $override :
      User::get('Preference.gui.icons.enabled');
    //$result = !is_null($result) ? $result : true;
    switch ($return) {
      case 'class':
        if($result)
          return Configure::read('App.gui.icons.class'); // @see icons.css
        else return '';
      break;
      default:
        return $result;
    }
  }

  /**
   * Should the content of tables be resizable?
   * @param $res result return type (class or boolean)
   * @return $result mixed
   */
  function isTableResizable($res='class'){
    $result = Configure::read('App.gui.tables.resizable');
    if($res=='class'){
      if($result) return 'resizable';
    } else {
      return $result;
    }
  }

  /**
   * Should the content of tables be wrapped?
   * @param $res result return type (class or boolean)
   * @return $result mixed
   */
  function isTableWrapable($res='class'){
    $result = Configure::read('App.gui.tables.nowrap');
    if($res=='class'){
      if($result) return 'nowrap';
    } else {
      return $result;
    }
  }

  /**
   * Return the available display options for the context
   * @return array mixed
   */
  function getViewModeOptions(){
    return $this->viewModeOptions;
  }

  /**
   * Set the display options available for the view
   * [!] If not set in the the view, best scenario will be assumed
   * @param $options array; from {'table','icons','list'}
   */
  function setViewModes($options){
    $this->viewModeOptions = array_intersect($options,$this->viewModeOptions);
  }

  /**
   * Return the message style (inline or dialog box)
   * @return string $style
   */
  function getMessageStyle(){
    $style = User::get('Preference.gui.messages.style');
    //$style = !is_null($style) ? $style : 'inline';
    return $style;
  }

  /**
   * Shall we show link as disabled?
   * @return bool
   */
  function showDisabledLinks(){
    return Configure::read('App.gui.links.show_disabled');
  }

  /**
   * Format the timestamp according to user preference
   * @param $date timestamp to convert
   */
  function date($date){
    $format = User::get('Locale.date.format');
    //@todo timezone
    return date($format,strtotime($date));
  }

}//_EOF
?>
