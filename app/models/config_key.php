<?php
class ConfigKey extends AppModel {
  var $name = 'ConfigKey';
  var $displayField = 'name';
  var $hasMany = array(
    'ConfigValues'
  );
}
?>