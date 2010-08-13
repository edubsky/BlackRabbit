<?php
class ConfigValue extends AppModel {
  var $name = 'ConfigValue';
  var $hasOne = array(
    'ConfigKey'
  );
}
?>