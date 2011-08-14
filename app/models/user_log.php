<?php
/**
 * User Log Model
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.model.user_log
 */
class UserLog extends AppModel {
  /**
   * @var array $belongsTo relationships
   */
  var $belongsTo = array(
    'User'
  );

  /**
   * Get the last n user log entries grouped by location
   * @param int $limit
   * @return array $results
   */
  static function get($limit=5){
    $_this = Common::getModel('UserLog');
    $results = $_this->find('all', array(
       'fields' => array(
         'resource','resource_id','get_data_url','get_data_named','action','user_id',
           'MAX(UserLog.created) as created'
       ),
       'conditions' => array(
         'user_id' => User::get('id'),
         'resource_type' => 'controller'
       ),
       'group' => array('resource_type','action','get_data_url'),
       'order' => 'created DESC',
       'limit' => $limit
    ));
    foreach($results as $i => $value){
      $results[$i]['UserLog']['created'] = $results[$i][0]['created'];
      unset($results[$i][0]);
    }
    //pr($results);
    return $results;
  }
}//_EOF
