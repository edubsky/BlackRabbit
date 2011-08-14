<?php
/**
 * Shortcuts element
 *
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     app.views.elements.shortcuts.ctp
 */
 $class = $this->DisplaySettings->useIcons();
 if(!empty($class)) $class = ' '.$class;
?>
<?php if(!User::isGuest()): ?>
  <div class="userbadge">
    <p><?php echo __('Welcome back')?> <strong><?php
             echo User::get('Person.firstname').' '
             .User::get('Person.lastname')
             .' ('.User::get('Role.name').')'; ?></strong>:</p>
    <span>
      <a href="<?php echo Router::Url('/users/preferences',true) ?>" class="preferences<?php echo $class; ?>"><?php echo __('preferences',true);?></a> |
      <a href="<?php echo Router::Url('/users/logout',true) ?>" class="logout<?php echo $class; ?>"><?php echo __('logout',true);?></a>
    </span>
  </div>
<?php endif; ?>
