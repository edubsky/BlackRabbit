<?php
/**
 * Pagination element
 * 
 * @copyright   2010 (c) Greenpeace International
 * @author      remy.bertot@greenpeace.org
 * @package     greenpeace.boost.views.elements.paging
 */
?>
  <div class="paging">
    <div class="counter">
      <?php echo $this->MyPaginator->counter(array('format' => __('Page %page% of %pages%', true)))."\n";?>
    </div>
    <div class="pages">
      <?php echo $this->MyPaginator->prev('« '.__('previous', true), array(), null, array('class'=>'disabled'))."\n";?>
<?php if($this->MyPaginator->hasNumber()): ?>
      <?php echo $this->MyPaginator->numbers(array('class'=>'number'))."\n"?>
<?php endif; ?>
      <?php echo $this->MyPaginator->next(__('next', true).' »', array(), null, array('class' => 'disabled'))."\n";?>
    </div>
    <div class="limit">
      <?php echo $this->MyPaginator->limit()."\n";?>
    </div>
  </div>
