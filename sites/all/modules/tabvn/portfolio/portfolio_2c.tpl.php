<?php
$hover = theme_get_setting('portfolio_hover', 'teach_it_prime');
if (empty($hover)) {
  $hover = 'hover-effect1';
}
?>
<section class="newSection row-fluid">
  <div class="filterPortfolio featuredWorks <?php print $hover; ?>">
    <?php
    require_once 'portfolio_filter.tpl.php';
    ?>


    <?php if (!empty($nodes)): ?>
      <!-- Portfolio items -->
      <ul class="portfolio group col2"> 

        <?php
        $i = 0;
        foreach ($nodes as $node) :
          ?>
          <?php
          $image_full = '';
          $image_field = field_get_items('node', $node, 'field_portfolio_image');
          if (!empty($image_field)) {
            $image_full = file_create_url($image_field[0]['uri']);
          }
          /* if (!empty($node->field_portfolio_image[LANGUAGE_NONE][0]['uri'])) {
            $image_full = file_create_url($node->field_portfolio_image[LANGUAGE_NONE][0]['uri']);
            } */
          ?>

          <li class="span6 item featuredWork" data-id="id-<?php print $i; ?>" data-type="<?php print portfolio_format_terms('field_portfolio_category', $node); ?>">

            <?php
            $image_uri = $image_field[0]['uri'];
            $image_url = file_create_url($image_uri);
            $style_name = 'portfolio_item';
            $node_url = url('node/' . $node->nid);
            $node_title = $node->title;
            ?>
            <?php print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri, 'attributes' => array('class' => array('displayHidden')))); ?>
            <div class="bg">
              <div class="content">
                <div class="front">
                  <?php
                  $image_style = image_style_url($style_name, $image_uri);
                  print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri));
                  ?>
                </div>

                <div class="backCon">
                  <div class="back">
                    <div class="header">
                      <h3 class="title"><?php print $node_title; ?></h3>
                      <div class="sep"></div>
                    </div>
                    <div class="describtion">
                      <p class="category"><small><?php print t('on'); ?></small> <?php print portfolio_format_comma_field('field_portfolio_category', $node, FALSE); ?></p>
                      <p><a href="<?php print $node_url; ?>"><?php print t('click here for more details'); ?></a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li> 
          <?php
          $i++;
        endforeach;
        ?>
      </ul>
    </div>
  </section>
<?php endif; ?>

