<?php 
$theme_path = drupal_get_path('theme', 'teach_it_prime');
?>
<?php if (!empty($nodes)): ?>
  <div id="bannerCon" class="clear drop-shadow">
    <div class="overflowHidden">
      <img class="prev" src="<?php print $theme_path; ?>/img/images/bt-prev.png" alt="Previous Frame">
      <img class="next" src="<?php print $theme_path; ?>/img/images/bt-next.png" alt="Next Frame">
      <div id="banner">
        <div id="sequence">
          <ul>
            <?php foreach ($nodes as $node): ?>
              <li>

                <?php
                $field_body = field_get_items('node', $node, 'field_slider_body');

                if (!empty($field_body[0]['value'])) {
                  print $field_body[0]['value'];
                }
                ?>
              </li>

            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>   
  </div>

<?php endif; ?>