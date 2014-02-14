<?php
if (empty($title)) {
  $title = t('Recent Work');
}
?>

<section class="newSection fcsCarousel col3">
  <h2 class="mainTitle"><?php print $title; ?></h2>
  <div class="carousel-items-con <?php print theme_get_setting('portfolio_hover', 'teach_it_prime'); ?> featuredWorks"> 
    <ul class="carousel-items">       
      <?php foreach ($nodes as $node):?>
      <li class="carousel-item featuredWork">
        <div class="bg">
          <div class="content">
            <div class="front">

              <?php
              $image_field = field_get_items('node', $node, 'field_portfolio_image');
              
              $image_uri = $image_field[0]['uri'];
              $image_url = file_create_url($image_uri);
              $style_name = 'portfolio_item';
              $node_url = url('node/' . $node->nid);

              $image = theme('image_style', array('style_name' => $style_name, 'path' => $image_uri));
              print $image;
              ?>

            </div>
            <div class="backCon">
              <div class="back">
                <div class="header">
                  <h3 class="title"><?php print $node->title; ?></h3>
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
      <?php endforeach; ?>


    </ul>            
    <!-- #slide Nav -->
    <!-- #slide Nav -->
    <div class="slider-nav">
      <a href="#" data-dir="prev" class="slider-btn prevSlide">&lsaquo;</a>
      <a href="#" data-dir="next" class="slider-btn nextSlide">&rsaquo;</a>
    </div> </div>
</section>