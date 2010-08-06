<?php
/**
 * Actions Row element
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.boost.views.elements.actions_row
 */
  $baseUrl = '';
?>
<?php echo $this->element($baseUrl.'actions', array(
  'id' => $id,
  'context' => 'row',
  'displayWrapper' => false,
  'displayHeader' => false,
  'displayEmpty'  => false,
  'displayList'   => false,
  'shortName' => true,
  'useIcons' => false
));
?>
