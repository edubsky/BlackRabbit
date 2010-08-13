<?php
class UserConfig extends AppModel {
  var $name = 'UserConfig';
  var $hasMany = array(
    'ConfigKey'
  );
}
?>