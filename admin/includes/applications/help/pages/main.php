<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
  Module Online Content (Help page)
  http://www.rubicshop.ru
  11.02.11
*/
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2" class="dataTable">
<tr><td align="left"><?php echo $osC_Language->get('store_version'); ?></td></tr>
</table>
<?php
	error_reporting(0);
	if (extension_loaded("curl")) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, "http://www.rubicshop.ru/rubic_help_content/text_curl.php");
	$r = curl_exec($ch);
	curl_close($ch);
	} else { $r=file_get_contents('http://www.rubicshop.ru/rubic_help_content/text_curl.php'); }
	if($r) $transfer_data=$r;
    echo $transfer_data;
?>
