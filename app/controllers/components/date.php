<?php
/**
 * Date Component
 * Basic Date Manipulation Functions
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controller.components.date
 */
class DateComponent extends Object {

  /**
   * Same - are the date the same
   *
   * @param string $date1
   * @param string $date2
   * @return boolean
   * @access public
   */
  static function same($date1, $date2, $type = 'month') {
    switch ($type) {
      case 'hour':
        $format = 'Y-m-d H:00';
        break;
      case 'day':
        $format = 'Y-m-d';
        break;
      case 'month':
        $format = 'Y-m';
        break;
      case 'year':
        $format = 'Y';
        break;
    }
    return date($format, strtotime($date1)) == date($format, strtotime($date2));
  }

  /**
   * Diff -  Difference between two dates
   *
   * @param string $startDate
   * @param string $endDate
   * @return array
   * @access public
   */
  static function diff($type, $startDate, $endDate, $count = true) {
    if ($count) {
      $map = array(
        'hour' => HOUR,
        'day' => DAY,
        'month' => MONTH,
        'year' => YEAR
      );
      return (strtotime($endDate) - strtotime($startDate)) / $map[$type];
    }

    $format = 'Y-m-d';
    if ($type == 'hour') {
      $format = 'Y-m-d H:00';
      $startDate = date($format, strtotime($startDate));
    }

    $startStamp = strtotime($startDate);
    $endStamp = strtotime($endDate);
    if ($startStamp >= $endStamp) {
      return array();
    }

    $endDate = date($format, $endStamp);

    $items = array();
    $i = 0;

    $reachedEnd = false;
    while (!$reachedEnd) {
      $s = '+' . $i . ' ' . $type . 's';
      $item = date($format, strtotime($s, $startStamp));
      $items[] = $item;
      if ($item == $endDate) {
        break;
      }
      $i++;
    }
    return $items;
  }
}//_EOF
