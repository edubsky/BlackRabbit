<?php if(isset($project_list)) : ?>
<div id="project_selector">
  <ul class="selector">
    <li>
      <div class="selected_item">
        <a href="/admin/home"><?php echo User::get('Project.name'); ?></a>
        <a href="<?php echo Router::url(); ?>#" class="trigger">
          <?php echo $html->image('layout/tab_arrow_down.png')."\n"; ?>
        </a>
      </div>
      <ul style="visibility:hidden;" class="sub_item">
<?php foreach($project_list as $project) : ?>
        <li><?php echo $html->link(); ?></li>
<?php // skip selected project ?>
<?php endforeach; ?>
      </ul>
    </li>
  </ul>
</div>
<?php endif; ?>
