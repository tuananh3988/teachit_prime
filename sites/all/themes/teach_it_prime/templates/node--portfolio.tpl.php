<section class="newSection row-fluid">
  <div id="node-<?php print $node->nid; ?>" class="singlePortfolio <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <!-- details -->
    <?php if ($page): ?>
      <?php if (!empty($content['field_portfolio_image'])): ?>
        <!-- image -->
        <div class="span8 singlePortfolioImage">
          <?php print render($content['field_portfolio_image']); ?>
        </div>
        <!-- // image -->
      <?php endif; ?>
      <div class="span4">
        <p class="desc"><?php print t('Project Details'); ?></p>
        <?php
        if (!empty($content['field_portfolio_link'])) {
          hide($content['field_portfolio_link']);
        }
        hide($content['comments']);
        hide($content['links']);
        print render($content);
        ?>
        <?php
        $link_field = field_get_items('node', $node, 'field_portfolio_link');
        if (!empty($link_field)):
          ?>
          <p class="portfolio-link"><a class="btn btn-theme-pri" href="<?php print url($link_field[0]['value']); ?>"><?php print t('LAUNCH PROJECT'); ?> 
              <span class="icon-share-alt"></span></a>
          </p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- // details -->

    <?php if (!$page): ?>

      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <div class="submitted">
          <?php print $submitted; ?>
        </div>
      <?php endif; ?>

      <div class="content"<?php print $content_attributes; ?>>
        <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        print render($content);
        ?>
      </div>
    <?php endif; ?>
    <?php print render($content['links']); ?>

    <?php print render($content['comments']); ?>

  </div>

</section>