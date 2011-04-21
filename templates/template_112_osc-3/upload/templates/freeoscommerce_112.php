<?php
/*
  $Id: $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2006 osCommerce
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $osC_Language->getTextDirection(); ?>" xml:lang="<?php echo $osC_Language->getCode(); ?>" lang="<?php echo $osC_Language->getCode(); ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $osC_Language->getCharacterSet(); ?>" />
<title><?php echo STORE_NAME . ($osC_Template->hasPageTitle() ? ' - ' . $osC_Template->getPageTitle() : ''); ?></title>
<base href="<?php echo osc_href_link(null, null, 'AUTO', false); ?>" />

<script language="javascript" src="ext/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>
<?php
if ($osC_Template->hasPageTags()) {
  echo $osC_Template->getPageTags();
}

if ($osC_Template->hasJavascript()) {
  $osC_Template->getJavascript();
}

if ($osC_Template->hasPageHeader()) { 
// Begin 'if has header'
// If page has a 'header', entire template will show -- otherwise, entire template will be hidden 
// This is needed to hide template for things like pop-up image boxes
?>
<link href="templates/freeoscommerce_112/freeoscommerce_112_stylesheet.css" rel="stylesheet" type="text/css" />
<?php
}
?>
<meta name="Generator" content="osCommerce" />
</head>

<body>
<?php
if ($osC_Template->hasPageHeader()) { 
// Begin 'if has header'
// If page has a 'header', entire template will show -- otherwise, entire template will be hidden
?>
<div id="wrapper1">
  <div id="background_top"></div>
  <div id="wrapper2">
    <div id="wrapper3">
      <div id="top_menu">
        <div id="top_menu_links">
          <span><a href="<?php echo osc_href_link(FILENAME_DEFAULT,null, 'SSL'); ?>">Home</a></span>   
<?php
  if ($osC_Customer->isLoggedOn()) {
?>
          <span>
<?php
    echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, 'logoff', 'SSL'), $osC_Language->get('sign_out'));
?>
          </span>
<?php
  }
?>
          <span>
<?php
  echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, null, 'SSL'), $osC_Language->get('my_account'));
?>
          </span>
          <span>
<?php
   echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'), $osC_Language->get('cart_contents'));
?> 
          </span>
          <span>
<?php
   echo osc_link_object(osc_href_link(FILENAME_CHECKOUT, 'shipping', 'SSL'), $osC_Language->get('checkout'));
?>
          </span>
        </div>
        <div id="website_name"><?php echo STORE_NAME; ?></div>
      </div>
      <div id="content_wrapper">
        <div id="side_menu">
<?php
$content_left = '';

if ($osC_Template->hasPageBoxModules()) {
  ob_start();

  foreach ($osC_Template->getBoxModules('left') as $box) {
    $osC_Box = new $box();
    $osC_Box->initialize();

    if ($osC_Box->hasContent()) {
      if ($osC_Template->getCode() == 'freeoscommerce_112') {
        include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
      } else {
        if (file_exists('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php')) {
          include('templates/' . $osC_Template->getCode() . '/modules/boxes/' . $osC_Box->getCode() . '.php');
        } else {
          include('templates/' . 'freeoscommerce_112' . '/modules/boxes/' . $osC_Box->getCode() . '.php');
        }
      }
    }

    unset($osC_Box);
  }

  $content_left = ob_get_contents();
  ob_end_clean();
}

if (!empty($content_left)) {
  echo $content_left;
} 
?>
        </div>
        <div id="content_wrapper2">
          <div id="content">
<?php
unset($content_left);
unset($content_right);

if ($osC_Services->isStarted('breadcrumb')) {
?>
          <div class="breadcrumbs">You are here: 
<?php
echo $osC_Breadcrumb->getPath();
?>
            <hr class="accessibility" />
          </div>
<?php
}

}
// End 'if has header'
// If page has a 'header', entire template will show -- otherwise, entire template will be hidden

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
      if ($osC_Template->getCode() == 'freeoscommerce_112') {
        include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
      } else {
        if (file_exists('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php')) {
          include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
        } else {
          include('templates/' . 'freeoscommerce_112' . '/modules/content/' . $osC_Box->getCode() . '.php');
        }
      }
    }
    unset($osC_Box);
  }
}

if ($osC_Template->getCode() == 'freeoscommerce_112') {
  include('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
} else {
  if (file_exists('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename())) {
    include('templates/' . $osC_Template->getCode() . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
  } else {
    include('templates/' . 'freeoscommerce_112' . '/content/' . $osC_Template->getGroup() . '/' . $osC_Template->getPageContentsFilename());
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
      if ($osC_Template->getCode() == 'freeoscommerce_112') {
        include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
      } else {
        if (file_exists('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php')) {
          include('templates/' . $osC_Template->getCode() . '/modules/content/' . $osC_Box->getCode() . '.php');
        } else {
          include('templates/' . 'freeoscommerce_112' . '/modules/content/' . $osC_Box->getCode() . '.php');
        }
      }
    }
    unset($osC_Box);
  }
}

if ($osC_Template->hasPageHeader()) { 
// Begin 'if has header'
// If page has a 'header', entire template will show -- otherwise, entire template will be hidden
?>
          <div style="width: 500px; margin: 25px; text-align: center;">
<?php
  if ($osC_Customer->isLoggedOn()) {
    echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, 'logoff', 'SSL'), $osC_Language->get('sign_out')) . ' &nbsp;|&nbsp; ';
  }

  echo osc_link_object(osc_href_link(FILENAME_ACCOUNT, null, 'SSL'), $osC_Language->get('my_account')) . ' &nbsp;|&nbsp; ' . osc_link_object(osc_href_link(FILENAME_CHECKOUT, null, 'SSL'), $osC_Language->get('cart_contents')) . ' &nbsp;|&nbsp; ' . osc_link_object(osc_href_link(FILENAME_CHECKOUT, 'shipping', 'SSL'), $osC_Language->get('checkout'));
if ($osC_Template->hasPageFooter()) {
  if ($osC_Services->isStarted('banner') && $osC_Banner->exists('468x60')) {
    echo '<p align="center">' . $osC_Banner->display() . '</p>';
  }
}
?>
          </div>
        </div>
          <div id="content_box_top"></div>
        </div>
      </div>
      <div id="main_image"></div>
    </div>
    <div id="left_shadow"></div>
    <div id="right_shadow"></div>
  </div>
</div>
<div id="bottom_stripe">
  <div id="content_box_bottom_wrapper">
    <div id="content_box_bottom"></div>
  </div>
</div>
<div id="footer">
  This is the footer.<br/><br/>
  <a style="color:#1a5673" href="http://freeoscommerce.com/" target="_blank">Free osCommerce Templates</a>
</div>
<?php
}
// End 'if has header'
// If page has a 'header', entire template will show -- otherwise, entire template will be hidden
?>
</body>
</html>