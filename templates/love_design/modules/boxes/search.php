<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<!-- box search start //-->

<div class="boxTitle"><li><ul><?php echo osc_link_object($osC_Box->getTitleLink(), $osC_Box->getTitle()); ?></ul></li></div>

<div class="boxContents" style="text-align: center;"><li><ul><?php echo $osC_Box->getContent(); ?></ul></li></div>

<div class="boxNew"><li><ul>&nbsp;</ul></li></div>

<!-- box search end //-->
