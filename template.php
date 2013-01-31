<?php

function mac_preprocess_page(&$variables) {
  $variables['image'] = '';
  if (isset($variables['node'])) :
    if($variables['node']->type == 'page'):       
      $node = node_load($variables['node']->nid);
      $output = field_view_field('node', $node, 'field_image', array('label' => 'hidden'));       
      $variables['image'] = $output;               
    endif;
  endif;
}

function mac_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id)  {
  	 	case 'webform_client_form_8':
        $form['submitted']['e_mail']['#attributes']['required'] = '';
        $form['actions']['submit']['#attributes']['class'][] = 'btn btn-custom';
        $form['#attributes']['class'][] = 'form-horizontal';
        break;
  }
}

function mac_form_element_label($variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();
 
  // If title and required marker are both empty, output no label.
  if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }
 
  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';
 
  $title = filter_xss_admin($element['#title']);
 
  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'] = 'option';
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'] = 'element-invisible';
  }
 
  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }
 
  $attributes['class'][] = 'control-label';
 
  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $t('!title', array('!title' => $title)) . "</label>";
}

function mac_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="nav nav-tabs">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}
