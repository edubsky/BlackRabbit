<?php
/**
 * Authentication Keys
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org / debuggable
 * @package     app.model.auth_key
 */
class AuthKey extends AppModel {
  var $name = 'AuthKey';
  var $belongsTo = array(
    'User'
  );

  function generate() {
    return String::uuid();
  }
}//_EOF

