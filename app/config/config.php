<?php
/**
 * Main application configuration file
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.config.config
 */
if (!defined('FULL_BASE_URL')) {
  define('FULL_BASE_URL', '');
}
$config = array(
  // General App Details
  'App.name' => 'Greenpeace Black Rabbit',
  'App.copyright' => '1971-2011 &copy; Greenpeace International',
  'App.browserTitle' => '%s | Greenpeace International', // %s = context
  'App.version' => array(
    'number' => '0.1',
    'name' => ' ~ BlackRabbit'
   ),

   // Environements Settings
  'App.environment' => 'development', // || development, staging, production
  'App.domain' => array(
    'development' => 'http://localhost/boost',
    'staging' => 'http://staging.boost.gl3',
    'production' => 'http://boost.gl3'
  ),

  // Cookie's settings
  'App.cookie' => array(
    'life' => '+1 month',
    'name' => 'BLACKRABBIT_APP'
  ),

  // Mailer settings
  'App.mailer' => array(
    'delivery' => 'debug', // mail, smtp or debug
    'smtpOptions' => array(
      'port' => '25',
      'timeout' => '30',
      'host' => 'smtp.greenpeace.org',
      'username' => 'noreply@greenpeace.org',
      'password' => ''
    ),
    'default' => array(
      'from' => 'Greenpeace <noreply@greenpeace.org>',
      'replyTo' => 'Greenpeace <noreply@greenpeace.org>',
      'format' => 'both', // html or text or both
      'subjectPrefix' => '[Greenpeace] '
    )
  ),
  'App.emails' => array(
    'support' => array(
      'name'  => 'Greenpeace Global Support Team',
      'email' => 'hotline@greenpeace.org'
    )
  ),

  // Secure Socket Layer
  /*
  'App.ssl' => array(
    'enabled' => false,
    'actions' => array(
      '/'
    )
  ),*/
  // AUTHENTICATION
  'App.auth' => array(
    'whitelist' => array(
      'login','logout',
      'forgot_password',
      'reset_password'
    ),
    // type of keys
    'keys' => array(
      'cookie' => array(
        'expire' => '+1 month'
      ),
      'reset' => array(
        'expire' => '+3 day'
      )
    )
  ),

  // LOGS
  // 0 - Do Nothing
  // 1 - Some details: action, resource name, date
  // 2 - More details: data submited, etc.
  'App.logs' => array(
    'models' => array(
      //'enabled' => true, // controlled by behavior
      'rules' => array(
        '*:find' => 0,
        '*:create' => 2,
        '*:update' => 2,
        '*:delete' => 1
      )
    ),
    'controllers' => array(
      //'enabled' => true, // controlled by component
      'rules' => array(
        'user:login' => array(
          'success' => 0, 'error' => 2
        ),
        '*:edit' => array(
           'success' => 1, 'error' => 2
        ),
        'CakeError:*' => 2,
        '*:*' => 1 // required for user history
      )
    )
  ),

  // CSS Settings
  // @see app.config.includes.css
  'App.css' => array(
    'compile' => false,
    'compileFolder' => 'aggregate',
    'tidy' => true,
    'includes' => 'includes' . DS . 'css'
  ),

  /*
  // 3rd Party - Recapcha
  'App.recaptcha' => array(
    'enabled'  => false,
    'conditions' => 'users:login'
    'publicKey' => '6LfXQgYAAAAAAHH3k76pZcBsbmsI6uustwK4lBF2',
    'privateKey' => '6LfXQgYAAAAAANChwyDVWumArldovDFn1O8G1TpW',
    'apiServer' => 'http://api.recaptcha.net',
    'apiSecureServer' => 'https://api-secure.recaptcha.net',
    'verifyServer' => 'api-verify.recaptcha.net'
  ),
  // Avatar
  'App.avatar' => array(
    'size' => '52',
    'default' => '/img/layout/defaultAvatar.png',
  ),
  */

  // GRAPHICAL USER INTERFACE OPTIONS
  'App.gui' => array(
    // Javascript
    'javascript' => array(
      'enabled' => true
    ),
    // View mode : compact, list, icons
    'viewModes' => array(
      'enabled' => true,
      'default' => 'list',
      'conditions' => '*:index,pages:home',
      'urlName' => 'viewMode',
      'options' => array(
         'list' => array(
           'name' => __('list view',true),
           'help' => __('view as a list',true)
          ),
          'icon' => array(
            'name' => __('icon view',true),
            'help' => __('view as icons',true)
          )/*,
          'compact' => array(
            'name' => __('compact',true),
            'help' => __('compact view',true)
          )*/
       )
    ),
    // iconic polution option
    'icons' => array(
      'class' => 'with_icon'
    ),
    // Some link properties
    'links' => array(
      'show_disabled' => true
    ),
    // Table accessories
    'tables' => array(
      'resizable' => false,   // resizable table collumn
      'nowrap' => true        // text wrap / hidden overflow
    ),
    // tooltips, small messages on hover
    'tooltips' => array(
      'enabled' => true,
      'class' => 'minitooltip'
    )
  ),

  // SOME GENERIC WIDGETS
  // breadcrumb
  /*'App.breadcrumb' => array(
    'enabled' => false,
    'conditions' => '*:*',
    'separator ' => '>'
  ),*/
  // some system shorcut
  /*'App.shortcuts' => array(
    'enabled' => true,
    'items' => array('print','bookmark','resize')
  ),*/

  // MODELS BEHAVIOR
  // Models for which favorites (starring) is enabled
  // @TODO behavior driven, needed for helper?
  'App.favorites' => array(
    'enabled' => true,
    'models' => array(
      'Project' => true,
      'User' => true
    )
  ),
  // Models for wich selections is enabled
  /*'App.selections' => array(
    'enabled' => true,
    'models' => array(
      'Project' => true,
      'User' => false
    )
  ),*/
  // Archive / Softdelete config
  'App.softdelete' => array(
    //'enabled' => true,
    'fields' => array(
      'archive_field' => 'archived',
      'delete_field' => 'deleted'
    ),
  )
);
//_EOF
