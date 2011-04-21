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



  class osC_Access_cms extends osC_Access {
    var $_module = 'cms',
        $_group = 'modules',
        $_icon = 'message-news.png',
        $_title,
        $_sort_order = 900;

    function osC_Access_cms() {
      global $osC_Language;

      $this->_title = $osC_Language->get('access_cms_title');

      $this->_subgroups = array(array('icon' => 'article.png',
                                      'title' => $osC_Language->get('access_cms_new_title'),  //new article
                                      'identifier' => 'action=save'),
                                array('icon' => 'application-x-ar.png',
                                      'title' => $osC_Language->get('access_cms_xsell_title'), // xsell
                                      'identifier' => 'action=xsell'));
                                      
    }
  }
?>
