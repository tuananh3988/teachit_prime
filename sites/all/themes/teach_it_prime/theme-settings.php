<?php

function teach_it_prime_form_system_theme_settings_alter(&$form, $form_state) {	
  $form['settings'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Theme settings'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['home'] = array(
      '#type' => 'fieldset',
      '#title' => t('Homepage settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['settings']['home']['home_tagline'] = array(
      '#type' => 'textarea',
      '#title' => t('Home tagline'),
      '#default_value' => theme_get_setting('home_tagline', 'teach_it_prime'),
  );
  
  $form['settings']['infomation'] = array(
      '#type' => 'fieldset',
      '#title' => t('Infomation settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  
  $form['settings']['infomation']['email'] = array(
      '#type' => 'textfield',
      '#title' => t('Email'),
      '#default_value' => theme_get_setting('email', 'teach_it_prime'),
  );
  
  $form['settings']['infomation']['mobile_phone'] = array(
      '#type' => 'textfield',
      '#title' => t('Mobile Phone'),
      '#default_value' => theme_get_setting('mobile_phone', 'teach_it_prime'),
  );

  $form['settings']['social_links'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['social_links']['twitter_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter URL'),
      '#default_value' => theme_get_setting('twitter_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook URL'),
      '#default_value' => theme_get_setting('facebook_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['google_plus_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Google+ URL'),
      '#default_value' => theme_get_setting('google_plus_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['linkedin_url'] = array(
      '#type' => 'textfield',
      '#title' => t('LinkedIn URL'),
      '#default_value' => theme_get_setting('linkedin', 'teach_it_prime'),
  );
  $form['settings']['social_links']['flickr_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Flickr URL'),
      '#default_value' => theme_get_setting('flickr_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['vimeo_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Vimeo URL'),
      '#default_value' => theme_get_setting('vimeo_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['rss_url'] = array(
      '#type' => 'textfield',
      '#title' => t('RSS URL'),
      '#default_value' => theme_get_setting('rss_url', 'teach_it_prime'),
  );
  $form['settings']['social_links']['dribble'] = array(
      '#type' => 'textfield',
      '#title' => t('Dribble URL'),
      '#default_value' => theme_get_setting('dribble_url', 'teach_it_prime'),
  );

  $form['settings']['portfolio'] = array(
      '#type' => 'fieldset',
      '#title' => t('Portfolio settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['portfolio']['default_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio display'),
      '#options' => array(
          '2c' => 'Portfolio - 2cols',
          '3c' => 'Portfolio - 3cols',
          '4c' => 'portfolio - 4cols',
      ),
      '#default_value' => theme_get_setting('default_portfolio', 'teach_it_prime'),
  );

  $form['settings']['portfolio']['portfolio_hover'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio hover effect'),
      '#options' => array(
          'hover-effect1' => 'Hover effect 1',
          'hover-effect2' => 'Hover effect 2',
          'hover-effect3' => 'Hover effect 3',
      ),
      '#default_value' => theme_get_setting('portfolio_hover', 'teach_it_prime'),
  );


  $form['settings']['portfolio']['default_nodes_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Number nodes show on portfolio page'),
      '#options' => drupal_map_assoc(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 100)),
      '#default_value' => theme_get_setting('default_nodes_portfolio', 'teach_it_prime'),
  );


  $form['settings']['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message', 'teach_it_prime'),
  );
  
  if (isset($form_state['build_info']['args'][0]) && ($theme = $form_state['build_info']['args'][0]) && color_get_info($theme) && function_exists('gd_info')) {
        $form['images'] = array(
            '#type' => 'fieldset',
            '#title' => t('Images scheme'),
            '#weight' => -1,
            '#attributes' => array('id' => 'images_scheme_form'),
        );
        $form['images'] += images_scheme_form($form, $form_state, $theme);
        //$form['#validate'][] = 'images_scheme_form_validate';
        $form['#submit'][] = 'images_scheme_form_submit';
    }

}