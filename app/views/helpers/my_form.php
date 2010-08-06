<?php
/**
 * My Form Helper
 * Overrides Cakephp default Form helper behavior
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.my_form
 */
class MyFormHelper extends FormHelper {
  /**
   * Input redefinition - required class += required span
   * @link http://book.cakephp.org/view/1390/Automagic-Form-Elements
   */
  function input($fieldName, $options = array()){
    if(isset($options['class']) && strstr('required',$options['class'])) {
      $options['label'] .= $this->required(); 
    }
    return parent::input($fieldName, $options)."\n";
  }
  
  /**
   * Required field special marker
   */
  function required(){
    return ' <span class="required">*</span>';
  }
  
  /**
   * Cancel button shortcut
   * @todo use system history 
   */
  function cancel(){
    return '<div class="submit cancel"><a href="javascript:history.go(-1);">« '.__('cancel',true).'</a></div>'."\n";
  }

  /**
   * See FormHelper::end
   */
  function end(){
    return parent::end()."\n";
  }

  /**
   * See FormHelper::submit
   */
  function submit($options){
    return parent::submit($options)."\n";
  }

  /**
   * @link http://book.cakephp.org/view/1423/error
   */
  function error($field, $text = null, $options = array()) {
    $defaults = array('wrap' => 'p', 'class' => 'message error', 'escape' => true);
    $options = am($defaults,$options);
    return parent::error($field,$text,$options);
  }
}//_EOF
?>