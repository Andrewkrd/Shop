<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  function osc_cfg_set_boolean_value($select_array, $default, $key = null) {
    global $osC_Language;

    $string = '';

    $select_array = explode(',', substr($select_array, 6, -1));

    $name = (!empty($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
      $value = trim($select_array[$i]);

      if (strpos($value, '\'') !== false) {
        $value = substr($value, 1, -1);
      } else {
        $value = (int)$value;
      }

      $select_array[$i] = $value;

      if ($value === -1) {
        $value = $osC_Language->get('parameter_false');
      } elseif ($value === 0) {
        $value = $osC_Language->get('parameter_optional');
      } elseif ($value === 1) {
        $value = $osC_Language->get('parameter_true');
      } elseif ($value === 10) {
        $value = $osC_Language->get('parameter_weight');
      } elseif ($value === 11) {
        $value = $osC_Language->get('parameter_price');
      } elseif ($value === 12) {
        $value = $osC_Language->get('parameter_test');
      } elseif ($value === 13) {
        $value = $osC_Language->get('parameter_production');
      } elseif ($value === 14) {
        $value = $osC_Language->get('parameter_selectedcurrency');
      } elseif ($value === 15) {
        $value = $osC_Language->get('parameter_sandbox');
      } elseif ($value === 16) {
        $value = $osC_Language->get('parameter_live');
      } elseif ($value === 17) {
        $value = $osC_Language->get('parameter_demo');
      } elseif ($value === 18) {
        $value = $osC_Language->get('parameter_certification');
      } elseif ($value === 19) {
        $value = $osC_Language->get('parameter_slot1');
      } elseif ($value === 20) {
        $value = $osC_Language->get('parameter_slot2');
      } elseif ($value === 21) {
        $value = $osC_Language->get('parameter_slot3');
      } elseif ($value === 22) {
        $value = $osC_Language->get('parameter_slot4');
      } elseif ($value === 23) {
        $value = $osC_Language->get('parameter_slot5');
      } elseif ($value === 24) {
        $value = $osC_Language->get('parameter_slot6');
      } elseif ($value === 25) {
        $value = $osC_Language->get('parameter_slot7');
      } elseif ($value === 30) {
        $value = $osC_Language->get('parameter_quantity1');
      } elseif ($value === 31) {
        $value = $osC_Language->get('parameter_quantity2');
      } elseif ($value === 32) {
        $value = $osC_Language->get('parameter_quantity3');
      } elseif ($value === 33) {
        $value = $osC_Language->get('parameter_quantity4');
      } elseif ($value === 34) {
        $value = $osC_Language->get('parameter_quantity5');
      } elseif ($value === 35) {
        $value = $osC_Language->get('parameter_quantity6');
      } elseif ($value === 36) {
        $value = $osC_Language->get('parameter_quantity7');
      } elseif ($value === 'random') {
        $value = $osC_Language->get('parameter_random');
      } elseif ($value === 'scrollUp') {
        $value = $osC_Language->get('parameter_scrollUp');
      } elseif ($value === 'scrollDown') {
        $value = $osC_Language->get('parameter_scrollDown');
      } elseif ($value === 'scrollLeft') {
        $value = $osC_Language->get('parameter_scrollLeft');
      } elseif ($value === 'scrollRight') {
        $value = $osC_Language->get('parameter_scrollRight');
      } elseif ($value === 'fade') {
        $value = $osC_Language->get('parameter_fade');
      } elseif ($value === 'growX') {
        $value = $osC_Language->get('parameter_growX');
      } elseif ($value === 'growY') {
        $value = $osC_Language->get('parameter_growY');
      } elseif ($value === 'zoom') {
        $value = $osC_Language->get('parameter_zoom');
      } elseif ($value === 'zoomFade') {
        $value = $osC_Language->get('parameter_zoomFade');
      } elseif ($value === 'zoomTL') {
        $value = $osC_Language->get('parameter_zoomTL');
      } elseif ($value === 'zoomBR') {
        $value = $osC_Language->get('parameter_zoomBR');
      }

      $string .= '<input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';

      if ($default == $select_array[$i]) $string .= ' checked="checked"';

      $string .= '> ' . $value . '<br />';
    }

    if (!empty($string)) {
      $string = substr($string, 0, -6);
    }

    return $string;
  }
?>
