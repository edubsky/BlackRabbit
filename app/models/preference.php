<?php
/**
 * User Preference Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.model.preference
 */
class Preference extends AppModel {
  var $name = 'preference';
  var $belongsTo = array(
    'User'
  );

  /**
   * After find callback
   * @param $result array
   * @result $result array
   */
  function afterFind($results) {
    $results2[0]['Preference'] = Configure::read('Preference');
    $skip = array('user_id','created','modified','id');
    foreach($results[0]['Preference'] as $key => $value) {
      if(isset($value) && !is_null($value)) {
        if(!in_array($key, $skip)) {
          $key = str_replace('_','.',$key);
          $results2[0]['Preference'] = Set::insert($results2[0]['Preference'], $key, $value);
        } else {
          $results2[0]['Preference'][$key] = $value;
        }
      }
    }
    return $results2;
  }
}//_EOF
?>
