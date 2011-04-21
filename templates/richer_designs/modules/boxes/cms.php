<?php
 /*
  $Id: $
  
  author Dave Howarth
  copyright 2008
  web http://www.box25.net
  email sales@box25.net
 
  Filename cms.php
  Desc Basic CMS system for osCommerce V3.0A5
  Modify by Gergely Tóth
  http://oscommerce-extra.hu
*/
?>

<!-- box cms start //-->
<div id="column-boxNew" class="column-box">
  <h3><?php echo osc_link_object($osC_Box->getTitleLink(), $osC_Box->getTitle()); ?></h3>

  <div class="column-box-contents"><?php echo $osC_Box->getContent(); ?></div>
</div><!-- box cms end //-->
