<?php
/**
 * Common Helper
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.helpers.common
 */
class CommonHelper extends AppHelper {
  /**
   * Format the timestamp according to user preference
   * @param $date timestamp to convert
   */
  static function date($date){
    $format = User::get('Locale.date.format');
    //@todo timezone
    return date($format,strtotime($date));
  }
}//_EOF
