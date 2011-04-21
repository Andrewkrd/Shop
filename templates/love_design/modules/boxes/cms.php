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
<div class="boxTitle"><li><ul><?php echo osc_link_object($osC_Box->getTitleLink(), $osC_Box->getTitle()); ?></ul></li></div>

<div class="boxContents"><li><ul><?php echo $osC_Box->getContent(); ?></ul></li></div>

<div class="boxNew"><li><ul>&nbsp;</ul></li></div>
</div><!-- box cms end //-->
