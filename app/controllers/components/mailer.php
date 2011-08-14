<?php
/**
 * Mailer Component
 * A redefinition of the default mail component
 * This is to avoid conflict with Email model name but
 * also adds in the mix the default system config & debug
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.controllers.components.mailer
 */
App::import('Component','Email');
class MailerComponent extends EmailComponent{
  /**
   * Initialize component
   * @param $controller
   * @param $settings
   * @return void
   */
  function initialize(&$controller,$settings=array()){
    parent::initialize($controlller,$settings);
    $this->Controller = $controller;
    // delivery configuration
    $this->delivery = Configure::read('App.mailer.delivery');
    if($this->delivery == 'smtp'){
     $this->smtpOptions = Configure::read('App.mailer.smtpOptions');
    }
    // default content header
    $this->replyTo = Configure::read('App.mailer.default.replyTo');
    $this->from = Configure::read('App.mailer.default.from');
    $this->sendAs = Configure::read('App.mailer.default.format');
    $this->xMailer = 'PHP Mailer Component';
  }

  /**
   * Send an email
   * @access public
   */
  function send() {
    parent::send();
    // Allows some debugging magik
    if($this->delivery == 'debug'){
      $debug = $this->Controller->Session->read('Message');
      if(!empty($debug)){
        $this->Controller->Message->debug(
          $debug['email']['message']
        );
        $this->Controller->Session->delete('Message');
      }
    }
  }
}//_EOF
