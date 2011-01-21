<?php
/**
 * Archiving Behavior
 * Allow softdelete
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.models.behaviors.loggable
 */
class ArchivableBehavior extends ModelBehavior {

  /**
   * Contain settings indexed by model name.
   * @var array
   * @access private
   */
  var $__settings = array();

  /**
   * Initiate behavior for the model using settings.
   *
   * @param object $Model Model using the behaviour
   * @param array $settings Settings to override for model.
   * @access public
   */
  function setup(&$Model, $settings = array()){
    $defaults = array(
      'archive_field' => Configure::read('App.softdelete.fields.archive_field')
    );

    if (!isset($this->__settings[$Model->alias])) {
      $this->__settings[$Model->alias] = $defaults;
    }

    $this->__settings[$Model->alias] = array_merge(
      $this->__settings[$Model->alias],
      (is_array($settings) ? $settings : array())
    );

  }

  /**
   * Archive a record
   * @parma string $model reference of the model instance
   * @param UUID $id of the record to archive
   * @param boolean $restore, archive or restore?
   */
  function archive(&$Model,$id,$restore=false){
    $success = false;
    if(Common::isUuid($id)) {
      $Model->data = $Model->read(null, $id);
      // check if exist
      if(!isset($Model->data[$Model->alias][$this->__settings[$Model->alias]['archive_field']])){
        throw new Exception(__('The resource doesn\'t exist. It may have been deleted.',true));
      } // check if is different state
      elseif($Model->data[$Model->alias][$this->__settings[$Model->alias]['archive_field']] != $restore) {
        if($restore) {
          throw new Exception(__('The resource is already active / restored.',true));
        } else {
          throw new Exception(__('The resource is already archived.',true));
        }
      }
      else {
        $Model->data = array();
        $Model->id = $id;
        $Model->data[$Model->alias][$this->__settings[$Model->alias]['archive_field']] = (!$restore);
        $success = $Model->save($Model->data);
      }
    } else {
      throw new Exception(__('The given ID is invalid.',true));
    }
    return $success;
  }

  /**
   * Restore an archived a record - uses archive()
   * @param string $model reference to the model instance
   * @param UUID $id of the record to restore
   */
  function restore(&$Model,$id){
    return $Model->archive($id, true);
  }
}//_EOF
?>
