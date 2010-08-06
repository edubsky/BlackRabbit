<?php
  $favorites = array(
    'Gift' => 3,
    'Transaction' => 5,
    'Contact' => 2
  );
  $favoritesCount = 10;
?>
<?php $widgets->header('favorites',__('Favorites',true),array('toogle' => true)); ?>
      <ul class="wrapper_toggle_favorites with_bullets">
        <li>
          <?php
          $label = sprintf(__('Gifts', true) . ' (%s)', $favorites['Gift']);
          echo $html->link($label, array(
            'controller' => 'gifts', 'action' => 'index', 'favorites',
            'plugin' => ''
          ));
          ?>
        </li>
        <li>
          <?php
          $label = sprintf(__('Supporters', true) . ' (%s)', $favorites['Contact']);
          echo $html->link($label, array(
            'controller' => 'supporters', 'action' => 'index', 'favorites',
            'plugin' => ''
          ));
          ?>
        </li>
        <li>
          <?php
          $label = sprintf(__('Transactions', true) . ' (%s)', $favorites['Transaction']);
          echo $html->link($label, array(
            'controller' => 'transactions', 'action' => 'index', 'favorites',
            'plugin' => ''
          ));
          ?>
        </li>
      </ul>
<?php $widgets->footer(); ?>