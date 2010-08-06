<?php
/**
 * My HTML Helper
 * Overrides Cakephp default HTML helper behavior
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.helpers.my_html
 */
class MyHtmlHelper extends HtmlHelper {
  var $helpers = array('DisplaySettings');

  /**
   * Table opening tag functionality
   * @override HtmlHelper::table very different!
   * @param $options{collumn_count} for table resize
   */
  function table($options){
    $res = '<table cellpadding="0" cellspacing="0" class="';
    $res.= $this->DisplaySettings->isTableResizable() . ' ';
    $res.= $this->DisplaySettings->isTableWrapable();
    $res.= '">';
    if(isset($options['collumn_count']) && Configure::read('App.gui.tables.resizable')) {
      $res.= $this->__getTableResizeTags($options['collumn_count']);
    }
    return $res . "\n";
  }

  /**
   * Allow tables collumn to be resized
   * @param $collumns number of table collumns to be displayed
   * @return $res mixed html bits and piece or false
   */
  function __getTableResizeTags($rows){
    $res = '<colgroup>';
    for($i=0;$i<$rows;$i++)
      $res.= '<col/>';
    $res.= '</colgroup>';
    return $res;
  }

  /**
   * Html::link redefinition
   * Don't generate link if disabled in options
   * @param $name
   * @param $url
   * @param $options
   */
  function link($name,$url,$options){
    if(isset($options['disabled']) && $options['disabled']){
      return '<span class="link disabled '.$options['class'].'">'.$name.'</span>';
    }else{
      return parent::link($name,$url,$options);
    }
  }
}//_EOF 
?>