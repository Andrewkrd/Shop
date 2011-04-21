<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<!-- module cms_sitemap start //-->

<div style="with: 49%;">
  <ul><li><?php echo osc_link_object(osc_href_link(FILENAME_CMS), $osC_Box->getTitle()); ?></li>
  <?php echo $osC_Box->getContent(); ?>
</div>

<!-- module cms_sitemap end //-->
