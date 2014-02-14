<!-- Category Filter -->
<div class="group">
  <?php
  $terms = array();
  $vid = NULL;
  $vid_machine_name = 'portfolio_categories';
  $vocabulary = taxonomy_vocabulary_machine_name_load($vid_machine_name);
  if (!empty($vocabulary->vid)) {
    $vid = $vocabulary->vid;
  }
  if (!empty($vid)) {
    $terms = taxonomy_get_tree($vid);
  }
  ?>
  <ul id="filters" class="filter clearfix"> 
    <li class="current all"><a href="#"><?php print t('All'); ?></a></li> 
    <?php if (!empty($terms)): ?>
      <?php foreach ($terms as $term): ?> 
        <li class="tid-<?php print $term->tid; ?>"><a href="#"><?php print $term->name; ?></a></li> 
      <?php endforeach; ?>
    <?php endif; ?>
  </ul> 
</div>