<?php
/**
 * Navigation configuration
 *
 * @copyright 2010 (c) Greenpeace International
 * @author    remy.bertot@greeenpeace.org
 * @package   app.config.navigation
 * @todo      database driven option?
 */
/**
 * Construction pattern is as follow:
 * App.navigation
 * - Navigation Section
 * --  Menu
 * ---   Menu Items
 *         name     name of the item on the menu (i18n)
 *         url      url to use if different than resources
 *         pattern  regexp used to check if the item is selected (based on current url)
 *         resource requested resource (for right management check)
 */
$config = array(
  'App.navigation' => array(
    // LEVEL 0 (MAIN TABS)
    'main' => array(
      'public' => array(
         // Get lost or die trying!
      ),
      'admin' => array(
        'home' => array(
          'name'    => __('Home', true),
          'url'     => '/home',
          'pattern' => '#/^(\/home.*|\/|\/pages\/home.*)$/iU',
          'resource' => 'pages:display'
        ),
        'projects' => array(
          'name'    => __('Projects', true),
          'url'     => '/projects/index',
          'pattern' => '#/\/projects.*/iU',
          'resource' => 'projects:index',
        ),
        'users' => array(
          'name'    => __('Users', true),
          'url'     => '/users/index',
          'pattern' => '#/\/users.*/iU',
          'resource' => 'users:index', 
        ),
        'help' => array(
          'name'    => __('Help', true),
          'url'     => '/help',
          'pattern' => '#/\/help.*/iU',
          'resource' => 'pages:display'
        )
      )
    ),
    // LEVEL 1 - Sub Tabs
    'sub' => array(
      'authentication' => array(
        'login' => array(
          'name'     => __('Login', true),
          'url'      => '/login',
          'pattern'  => '#/^(.*\/login|\/users\/login).*$/iU',
          'resource' => 'users:login'
        ),
        'lostPassword' => array(
          'name'     => __('Lost password?', true),
          'url'      => '/password/forgot',
          'pattern'  => '#/^(.*\/password\/(forgot|reset)|\/users\/forgot_password).*$/iU',
          'resource' => 'users:forgot_password'
        )
      ),
      'projects:index' => array(
        'all' => array(
          'name'     => __('all', true),
          'url'      => '/projects/index/all',
          'pattern'  => '#/^\/projects((?!archived).)*$/iU',
          //'#/^\/projects\/(index(\/(all)?)?)?)?(\/(.)*)*$/iU',
          'resource' => 'projects:index:all'
        ),
        'archived' => array(
          'name'     => __('archived', true),
          'url'      => '/projects/index/archived',
          'pattern'  => '#/^\/projects\/index\/archived(\/(.)*)*$/iU',
          'resource' => 'projects:index:archived'
        )
      )
      , 'user_preferences' => array(
        __('Preferences', true) => array(
          '/admin/users/preferences'
          , '#/^\/admin\/users\/preferences.*$/iU'
        )
        , __('Edit Password', true) => array(
          '/admin/users/edit_password'
          , '#/^\/admin\/users\/edit_password.*$/iU'
        )
      )
        /*, __('Public Key', true) => array(
          '/admin/users/public_key'
          , '#/^\/admin\/users\/public_key.*$/iU'
        )
        , __('Email Reports', true) => array(
          '/admin/users/email_reports'
          , '#/^\/admin\/users\/email_reports.*$/iU'
          , 'condition' => User::allowed('Users', 'admin_email_reports')
        )
      )*/
    )
  )
);//_EOF
