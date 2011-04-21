<?php

  // grab the item requested
  $QinfoDetails = osC_Info::getDetails();
  
?>
<h1><?php echo $osC_Template->getPageTitle(); ?></h1>
<?php
    echo '<div class="moduleBox">
    		<div>' . nl2br($QinfoDetails->value("info_description")) . '</div>
		  </div>'
			  
?>

<div class="submitFormButtons" style="text-align: right;">
  <?php echo $osC_Template->osc_draw_image_jquery_button(array('href' => osc_href_link(FILENAME_INFO), 'icon' => 'triangle-1-e', 'title' => $osC_Language->get('button_continue'))); ?>
</div>

