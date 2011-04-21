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

  class osC_Access_info extends osC_Access {
    var $_module = 'info',
        $_group = 'modules',
        $_icon = 'info.png',
        $_title,
        $_sort_order = 900;

    function osC_Access_info() {
      global $osC_Language;

      $this->_title = $osC_Language->get('access_info_title');
    }
  }
?>