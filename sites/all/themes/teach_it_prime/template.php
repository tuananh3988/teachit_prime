<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega)
 * provides all the basic functionality. However, in case you wish to customize
 * the output that Drupal generates through Alpha & Omega this file is a good
 * place to do so.
 *
 * Alpha comes with a neat solution for keeping this file as clean as possible
 * while the code for your subtheme grows. Please read the README.txt in the
 * /preprocess and /process subfolders for more information on this topic.
 */
include_once 'includes/custom_menu.inc';

function teach_it_prime_preprocess_block(&$variables) {
	debug($variables);
}

function teach_it_prime_process_region(&$vars) {
  $custom_main_menu = _custom_main_menu_render_superfish();
  if (!empty($custom_main_menu['content'])) {
    $vars['navigation'] = $custom_main_menu['content'];
  }
  
}


/**
 * Override or insert vars into the node template.
 */
function teach_it_prime_preprocess_node(&$vars) {
  if ($vars['view_mode'] == 'full' && node_is_page($vars['node'])) {
    // @TODOS: see if needed.
    $vars['classes_array'][] = 'node-full';
  }
  else {
    // We need to distinguish the first node on front page teasers.
    // So we count the nodes for each teasers page request.
    static $numbered = 1;
    // Initialize default fonfolio node teaser class to 'post-box'.
    // 'post-box' class styles the smaller node boxes on typical teach_it_prime
    // teaser lists.
    $teaser_box_type = 'post-box';
    
    // teach_it_prime has different way to style node teasers if presented as part
    // of default blog teasers list. We recognize such list if its first URL 
    // parameter is "blog".
    // But we dont want to use this style if blog displayed at site frontpage.
    // So we set different class for Blog teaser.
    if (arg(0) == 'blog' && !($vars['is_front'])) {
      $teaser_box_type = 'blog-box';
    }
    
    $vars['classes_array'][] = $vars['zebra'];
    
    // Set first teaser node classes to allow the bigger dimentions for first teaser.
    if ($numbered == 1) {
      $vars['classes_array'][] = 'first';
      $numbered++;
      if ($vars['is_front']) {
        $teaser_box_type = 'big-post-box';
      }
    }

    $vars['classes_array'][] = $teaser_box_type;
  }
}

function teach_it_prime_preprocess_page(&$vars) {

  if (arg(0) == 'node' && arg(1)) {
    $nid = arg(1);

    $node = node_load($nid);
    switch ($node->type) {
      case 'blog':
        $vars['title'] = t('Blog');

        break;
    }
  }
}

/**
 * Implements template_process_html().
 *
 */
function teach_it_prime_process_html(&$variables) {
    global $theme_key;
    // Hook into color.module.
    if (module_exists('color')) {
        _color_html_alter($variables);
    }
    
    
    
}

/**
 * Implements template_process_page().
 */
function teach_it_prime_process_page(&$vars, $hook) {
    // Hook into color.module.
    if (module_exists('color')) {
        _color_page_alter($variables);
    }
}


function images_scheme_form($complete_form, $form_state, $theme) {
    $images_bg = variable_get('color_' . $theme . '_images', array());
		//variable_del('color_' . $theme . '_images', array());
    $info = color_get_info($theme);
    $names = $info['images']['fields'];
    foreach ($info['images']['source'] as $name => $value) {
        if (isset($names[$name])) {
            $form['images'][$name][$name] = array(
                '#type' => 'file',
                '#title' => check_plain($names[$name]),
                    //'#default_value' => $value,
                    //'#size' => 8,
                '#attributes' => array('class' => array($name . '-file')),
            );
            
            if(isset($images_bg[$name])) {
                $img_preview = file_create_url($images_bg[$name]->uri);
                $img_preview = '   <img src="' . $img_preview .'" width="30" height="30"/>';
                //var_dump($img_preview);die;
                $form['images'][$name][$name]['#description'] = check_plain($images_bg[$name]->filename) . $img_preview;
                $form['images'][$name]['remove'] = array(
                    '#type' => 'button',
                    '#value' => t('Remove'),
                    '#attributes' => array('onclick' => 'return false;', 'class' => array('image-remove-button'), 'id-field' => $name),
                );
                $form['images'][$name]['remove-flg-' . $name] = array(
                    '#type' => 'hidden',
                    '#default_value' => 0,
                );    
            }            
        }
    }
		
		//get all list font anwsome
		$fontAnwsome = db_select('teachit_font_anwsome', 'c')
    ->fields('c')
    ->execute()
    ->fetchAll();
		
		$html = '';
		foreach($fontAnwsome as $font) {
			$html .= '<span value="'. substr($font->class, 1) .'" style="font-size:30px; margin-right: 3px;" class="font-anwsome-init ' . substr($font->class, 1) . '"></span>';
		}
			
		//create textfields
		$textfields = $info['textfields'];
		foreach($textfields as $k => $v) {
			if(isset($v['type_field']) && $v['type_field'] == 'font_anwsome') {
				$v['#prefix'] = '<div class="' . $k . '">';
				$v['#suffix'] = $html . '</div>';
				unset($v['type_field']);
			}
			$form['customfield'][$k] = $v;
		}
	
    drupal_add_js(drupal_get_path('theme', $theme) . '/js/teachit.js');
		drupal_add_css(drupal_get_path('theme', $theme) . '/css/font-awesome.css');
    return $form;
}

function images_scheme_form_submit($form, &$form_state) {
    $values = $form_state['values'];
		var_dump($values);die;
    $theme = $form_state['build_info']['args'][0];
    $filepath = 'public://teach_it_prime_images/';
    file_prepare_directory($filepath, FILE_CREATE_DIRECTORY);
    $info = color_get_info($theme);
    $images = $info['images'];
    $names = $images['fields'];
    $images_bg = variable_get('color_' . $theme . '_images', array());
	
    
    foreach ($images['source'] as $name => $value) {
        if (isset($names[$name])) {
            if(isset($values['remove-flg-' . $name]) && $values['remove-flg-' . $name] === '1') {
                file_delete($images_bg[$name]);
                $images_bg[$name] = NULL;
            }
            
            $file = file_save_upload($name, array('file_validate_extensions' => array()), $filepath, FILE_EXISTS_RENAME);
            if ($file && !is_null($file)) {
                if(isset($images_bg[$name])) {
                    file_delete($images_bg[$name]);
                }
                
                $file->status = FILE_STATUS_PERMANENT;
                file_save($file);
                $images_bg[$name] = $file;
                
            }
        }
    }
    
    
    $css = '';
    foreach ($images['css'] as $name => $value) {
        if(isset($images_bg[$name]->uri)) {
            $url = file_create_url($images_bg[$name]->uri);
            $css .= $value . ' { background-image: url(' . $url . ');}';
        }
        
    }
    
		//save custom field data
		
    $base_file = drupal_basename('bg_styles.css');
    $file_css = $filepath . $base_file;
    $filepath = file_unmanaged_save_data($css, $file_css, FILE_EXISTS_REPLACE);

    // Set standard file permissions for webserver-generated files.
    drupal_chmod($file_css);
    
    variable_set('color_' . $theme . '_images', $images_bg);
    variable_set('color_' . $theme . '_images_file', $filepath);

}

function color_get_images($theme, $default = FALSE) {
    // Fetch and expand default palette.
    $info = color_get_info($theme);
    $images = $info['images'];
    // Load variable.
    return $default ? $images : variable_get('color_' . $theme . '_images', $images);
}


// Add link for Ubuntu font
drupal_add_css('http://fonts.googleapis.com/css?family=Ubuntu', array('group' => CSS_THEME, 'type' => 'external'));

global $theme_key;
$css = variable_get('color_' . $theme_key . '_images_file');
drupal_add_css(file_create_url($css), array('group' => CSS_THEME, 'type' => 'external'));