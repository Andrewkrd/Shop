<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

#print_r($osC_Language);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $osC_Language->getTextDirection(); ?>" xml:lang="<?php echo $osC_Language->getCode(); ?>" lang="<?php echo $osC_Language->getCode(); ?>">

<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $osC_Language->getCharacterSet(); ?>" />
	<meta http-equiv="x-ua-compatible" content="ie=9" />
	<title><?php echo STORE_NAME . ($osC_Template->hasPageTitle() ? ': ' . $osC_Template->getPageTitle() : ''); ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo 'templates/' . $osC_Template->getCode() . '/images/favicon.ico'; ?>" />
	<base href="<?php echo osc_href_link(null, null, 'AUTO', false); ?>" />

	<script language="javascript" src="ext/jquery/jquery-1.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo $osC_Template->getCode(); ?>/buttons/jquery-ui-1.8.11.custom.css" />
	<script type="text/javascript" src="ext/jquery/ui/jquery-ui-1.8.11.custom.min.js"></script>

	<link rel="stylesheet" type="text/css" href="templates/<?php echo $osC_Template->getCode(); ?>/stylesheet.css" />
	<link href="ext/noobslide/styles.css" media="screen" rel="stylesheet" type="text/css" />
	<script language="javascript" type="text/javascript" src="ext/noobslide/noobslide.js"></script>

<?php
  if ($osC_Template->hasPageTags()) {
    echo $osC_Template->getPageTags();
  }

  if ($osC_Template->hasJavascript()) {
    $osC_Template->getJavascript();
  }
?>
	<!-- Include Lightbox (Production) -->
	<script language="javascript" src="ext/jquery/jquery.lightbox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="templates/<?php echo $osC_Template->getCode(); ?>/jquery.lightbox.css" />

	<meta name="Generator" content="RuBiC" />

</head>

<body>

<div id="container">

<?php
	if ($osC_Template->hasPageHeader()) {
?>

<!-- header //-->
	<div id="header">

		<div id="header-logo">

			<?php echo osc_link_object(osc_href_link(FILENAME_DEFAULT), osc_image('templates/' . $osC_Template->getCode() . '/images/store_logo.jpg', STORE_NAME), 'id="siteLogo"'); ?>

		</div>

		<div id="header-links">

			<div id="header-links-basket">

				<h5><?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'), $osC_Language->get('cart_contents')); ?> <?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'),  osc_image('templates/' . $osC_Template->getCode() . '/images/header-links-basket.png', $osC_Language->get('cart_contents'))); ?></h5>

				<?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'),  $osC_ShoppingCart->numberOfItems() . ' ' . $osC_Language->get('items') . ' - ' . $osC_Currencies->format($osC_ShoppingCart->getTotal())); ?>

			</div>

		</div>

		<div id="header-nav-top" class="header-nav-top">

			<ul>

<?php
    if ($osC_Services->isStarted('breadcrumb')) {
			$bread_crumb = $osC_Breadcrumb->getArray();
			$num_tabs = sizeof($bread_crumb)-1;
			foreach( $bread_crumb as $key => $value ) {
				echo "\t" . '<li' . ($key == $num_tabs ? ' class="selected"' : '') . '>' . $value . '</li>' . "\n";
			}
    }
?>

			</ul>

		</div>

		<div id="header-nav-search">

			<form name="search" action="search.php" method="get">

				<p><?php echo $osC_Language->get('button_search'); ?>:</p>

				<p><?php echo osc_draw_input_field('keywords', null, 'id="header-nav-search-box" size="24"'); ?></p>

				<p><input type="image" id="header-nav-search-go" src="templates/<?php echo $osC_Template->getCode(); ?>/images/header-nav-search-go.png"></p>

			</form>

		</div>

		<div id="header-nav-lower">

			<ul>

				<li><?php echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, null, 'SSL'), $osC_Language->get('my_account')); ?></li>

				<li><?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'), $osC_Language->get('cart_contents')); ?></li>

				<li><?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, 'shipping', 'SSL'), $osC_Language->get('checkout')); ?></li>

<?php
	if ($osC_Customer->isLoggedOn()) {
?>
				<li><?php echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, 'logoff', 'SSL'), $osC_Language->get('sign_out')); ?></li>
<?php	      
	}
?>

			</ul>

		</div>

	</div>

<!-- eof_header //-->
<?php
	} // hasPageHeader
?>
<div id="slideShow">
<?php
  if ($osC_Template->hasPageContentModules()) {
    foreach ($osC_Services->getCallAfterPageContent() as $service) {
      $$service[0]->$service[1]();
    }

    foreach ($osC_Template->getContentModules('slideshow') as $box) {
      $osC_Box = new $box();
      $osC_Box->initialize();

      if ($osC_Box->hasContent()) {
        if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
          include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
        } else {
          if (file_exists('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php')) {
            include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
          } else {
            include('templates/' . DEFAULT_TEMPLATE . '/modules/content/' . $osC_Box->getCode() . '.php');
          }
        }
      }

      unset($osC_Box);
    }
  }
?>
</div>
<?php
	$content_left = '';

	if ($osC_Template->hasPageBoxModules()) {
	  ob_start();

	  foreach ($osC_Template->getBoxModules('left') as $box) {
	    $osC_Box = new $box();
	    $osC_Box->initialize();

	    if ($osC_Box->hasContent()) {
	      if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
	        include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
	      } else {
	        if (file_exists('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php')) {
	          include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
	        } else {
	          include('templates/' . DEFAULT_TEMPLATE . '/modules/boxes/' . $osC_Box->getCode() . '.php');
	        }
	      }
	    }

	    unset($osC_Box);
	  }

	  $content_left = ob_get_contents();
	  ob_end_clean();

  	if (!empty($content_left)) {
?>

<!-- left_column //-->
	<div id="left-column">   

<?php
    echo $content_left;
?>

	</div>	
<!-- eof_left_column //-->

<?php
		}
	}
?>		

<!-- main_column //-->
	<div id="main-column">

<?php
  if ($osC_MessageStack->size('header') > 0) {
    echo $osC_MessageStack->get('header');
  }

  if ($osC_Template->hasPageContentModules()) {
    foreach ($osC_Services->getCallBeforePageContent() as $service) {
      $$service[0]->$service[1]();
    }

    foreach ($osC_Template->getContentModules('before') as $box) {
      $osC_Box = new $box();
      $osC_Box->initialize();

      if ($osC_Box->hasContent()) {
        if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
          include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
        } else {
          if (file_exists('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php')) {
            include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
          } else {
            include('templates/' . DEFAULT_TEMPLATE . '/modules/content/' . $osC_Box->getCode() . '.php');
          }
        }
      }

      unset($osC_Box);
    }
  }

  if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
    include('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
  } else {
    if (file_exists('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename())) {
      include('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
    } else {
      include('templates/' . DEFAULT_TEMPLATE . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
    }
  }
?>

<div style="clear: both;"></div>

<?php
  if ($osC_Template->hasPageContentModules()) {
    foreach ($osC_Services->getCallAfterPageContent() as $service) {
      $$service[0]->$service[1]();
    }

    foreach ($osC_Template->getContentModules('after') as $box) {
      $osC_Box = new $box();
      $osC_Box->initialize();

      if ($osC_Box->hasContent()) {
        if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
          include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
        } else {
          if (file_exists('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php')) {
            include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
          } else {
            include('templates/' . DEFAULT_TEMPLATE . '/modules/content/' . $osC_Box->getCode() . '.php');
          }
        }
      }

      unset($osC_Box);
    }
  }
?>

	</div>
<!-- eof_main_column //-->
  

<?php
  $content_right = '';

  if ($osC_Template->hasPageBoxModules()) {
    ob_start();

    foreach ($osC_Template->getBoxModules('right') as $box) {
      $osC_Box = new $box();
      $osC_Box->initialize();

      if ($osC_Box->hasContent()) {
        if ($osC_Template->getCode() == DEFAULT_TEMPLATE) {
          include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
        } else {
          if (file_exists('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php')) {
            include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
          } else {
            include('templates/' . DEFAULT_TEMPLATE . '/modules/boxes/' . $osC_Box->getCode() . '.php');
          }
        }
      }

      unset($osC_Box);
    }

    $content_right = ob_get_contents();
    ob_end_clean();
  }

  if (!empty($content_right)) {
?>

<!-- right_column //-->
	<div id="right-column">	

<?php
    echo $content_right;
?>

	</div>
<!-- eof_right_column //-->

<?php
	}
?>

</div>

<?php 

  if ($osC_Template->hasPageFooter()) {
  
         if ($osC_Services->isStarted('banner') && $osC_Banner->exists('468x60')) {
      echo $osC_Banner->display();
    }
?>

<div id="footer-container">

	<div id="footer">

		<div id="footer-navigation">

			<ul>

				<li><?php echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, null, 'SSL'), $osC_Language->get('my_account')); ?></li>

				<li><?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'), $osC_Language->get('cart_contents')); ?></li>

				<li class="last"><?php echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, 'shipping', 'SSL'), $osC_Language->get('checkout')); ?></li>

			</ul>

		</div>
		
	</div>

	<div id="footer-copy">
		<?php echo sprintf($osC_Language->get('footer'), date('Y'), osc_href_link(FILENAME_DEFAULT), STORE_NAME); ?> | <a href="http://www.richerdesigns.com" target="_blank">eCommerce Design</a> by Richer Designs
	</div>

</div>		


<?php

  }
?>

</body>

</html>
