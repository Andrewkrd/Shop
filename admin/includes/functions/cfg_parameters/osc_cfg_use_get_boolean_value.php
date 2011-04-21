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

  function osc_cfg_use_get_boolean_value($string) {
    global $osC_Language;

    switch ($string) {
      case -1:
      case '-1':
        return $osC_Language->get('parameter_false');
        break;

      case 0:
      case '0':
        return $osC_Language->get('parameter_optional');
        break;

      case 1:
      case '1':
        return $osC_Language->get('parameter_true');
        break;

      case 10:
      case '10':
        return $osC_Language->get('parameter_weight');
        break;
		
      case 11:
      case '11':
        return $osC_Language->get('parameter_price');
        break;		

      case 12:
      case '12':
        return $osC_Language->get('parameter_test');
        break;	

      case 13:
      case '13':
        return $osC_Language->get('parameter_production');
        break;	

      case 14:
      case '14':
        return $osC_Language->get('parameter_selectedcurrency');
        break;	

      case 15:
      case '15':
        return $osC_Language->get('parameter_sandbox');
        break;	

      case 16:
      case '16':
        return $osC_Language->get('parameter_live');
        break;	

      case 17:
      case '17':
        return $osC_Language->get('parameter_demo');
        break;	
		
      case 18:
      case '18':
        return $osC_Language->get('parameter_certification');
        break;		

      case 19:
      case '19':
        return $osC_Language->get('parameter_slot1');
        break;	

      case 20:
      case '20':
        return $osC_Language->get('parameter_slot2');
        break;	

      case 21:
      case '21':
        return $osC_Language->get('parameter_slot3');
        break;	

      case 22:
      case '22':
        return $osC_Language->get('parameter_slot4');
        break;	

      case 23:
      case '23':
        return $osC_Language->get('parameter_slot5');
        break;	

      case 24:
      case '24':
        return $osC_Language->get('parameter_slot6');
        break;	

      case 25:
      case '25':
        return $osC_Language->get('parameter_slot7');
        break;			

       case 'random':
      case 'random':
        return $osC_Language->get('parameter_random');
        break;	

      case 'scrollUp':
      case 'scrollUp':
        return $osC_Language->get('parameter_scrollUp');
        break;

      case 'scrollDown':
      case 'scrollDown':
        return $osC_Language->get('parameter_scrollDown');
        break;

      case 'scrollLeft':
      case 'scrollLeft':
        return $osC_Language->get('parameter_scrollLeft');
        break;

      case 'scrollRight':
      case 'scrollRight':
        return $osC_Language->get('parameter_scrollRight');
        break;

      case 'fade':
      case 'fade':
        return $osC_Language->get('parameter_fade');
        break;

      case 'growX':
      case 'growX':
        return $osC_Language->get('parameter_growX');
        break;

      case 'growY':
      case 'growY':
        return $osC_Language->get('parameter_growY');
        break;

      case 'zoom':
      case 'zoom':
        return $osC_Language->get('parameter_zoom');
        break;

      case 'zoomFade':
      case 'zoomFade':
        return $osC_Language->get('parameter_zoomFade');
        break;

      case 'zoomTL':
      case 'zoomTL':
        return $osC_Language->get('parameter_zoomTL');
        break;

      case 'zoomBR':
      case 'zoomBR':
        return $osC_Language->get('parameter_zoomBR');
        break;
        
      default:
        return $string;
        break;
    }
  }
?>
