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
  
  RuBiC modify (http://www.rubicshop.ru)
*/
  require('includes/applications/cms/classes/cms.php');

  class osC_Application_cms extends osC_Template_Admin {

/* Protected variables */

    protected $_module = 'cms',
              $_page_title,
              $_page_contents = 'main.php';

/* Class constructor */

    function __construct() {
      global $osC_Language, $osC_MessageStack;

      $this->_page_title = $osC_Language->get('heading_title');

      if ( !isset($_GET['action']) ) {
        $_GET['action'] = '';
      }

      if ( !isset($_GET['page']) || ( isset($_GET['page']) && !is_numeric($_GET['page']) ) ) {
        $_GET['page'] = 1;
      }

      if ( !empty($_GET['action']) ) {
        switch ($_GET['action']) {
//          case 'preview':
//            $this->_page_contents = 'preview.php';
//            break;

          case 'save':
            $this->_page_contents = 'edit.php';

            if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'confirm') ) {
              $error = false;

              $data = array('cms_name' => $_POST['cms_name'],
                            'active' => $_POST['active'],
                            'cms_short_text' => $_POST['cms_short_text'],
                            'cms_description' => $_POST['cms_description']);

              if ( $error === false ) {
                if ( osC_cms_Admin::save((isset($_GET['pID']) && is_numeric($_GET['pID']) ? $_GET['pID'] : null), $data) ) {
                  $osC_MessageStack->add($this->_module, $osC_Language->get('ms_success_action_performed'), 'success');
                } else {
                  $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed'), 'error');
                }

                osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module . '&page=' . $_GET['page']));
              }
            }

            break;

          case 'delete':
            $this->_page_contents = 'delete.php';

            if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'confirm') ) {
              if ( osC_cms_Admin::delete($_GET['pID']) ) {
                $osC_MessageStack->add($this->_module, $osC_Language->get('ms_success_action_performed'), 'success');
              } else {
                $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed'), 'error');
              }

              osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module . '&page=' . $_GET['page']));
            }

            break;

          case 'batchDelete':
            if ( isset($_POST['batch']) && is_array($_POST['batch']) && !empty($_POST['batch']) ) {
              $this->_page_contents = 'batch_delete.php';

              if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'confirm') ) {
                $error = false;

                foreach ($_POST['batch'] as $id) {
                  if ( !osC_cms_Admin::delete($id) ) {
                    $error = true;
                    break;
                  }
                }

                if ( $error === false ) {
                  $osC_MessageStack->add($this->_module, $osC_Language->get('ms_success_action_performed'), 'success');
                } else {
                  $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed'), 'error');
                }

                osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module . '&page=' . $_GET['page']));
              }
            }

            break;
            
          case 'xsell':
            $this->_page_contents = 'xsell.php';

            if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'sort_confirm') ) {
                $error = false;
          
                foreach ($_POST as $value => $xvalue) {
                        $data = array('xsell_id' => $value,
                                      'short_order' => $xvalue,
                                      'cms_id' => $_GET['add_related_article_ID']);                    

                        if ( !osC_cms_Admin::xsell_save_sort($data) ) {
                            $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed'), 'error');
                            $error = true;
                        }
                }   
            
                if ( $error === false ) {
                    $osC_MessageStack->add($this->_module, $osC_Language->get('ms_success_action_performed'), 'success');
                    osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module .
                    '&action=xsell&sort=1&add_related_article_ID=' .
                    $_GET['add_related_article_ID']));
                }

            }

            if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'categories_confirm') ) {
                $error = false;
                
                   osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module .
                    '&action=xsell&cPath=' . $_POST['cPath'] . '&add_related_article_ID=' .
                    $_GET['add_related_article_ID']));

            }            

            if ( isset($_POST['subaction']) && ($_POST['subaction'] == 'save_confirm') ) {
                $error = false;

                if ($_POST['run_update'] == true) {
                                            
                
                       $data = array('cms_id' => $_GET['add_related_article_ID']);

                        if ( !osC_cms_Admin::xsell_delete_all($data)) {
                            $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed') . " in delete process", 'error');
                            $error = true;
                        }
                }
                
                if (isset($_POST['xsell_id']) && ($_POST['xsell_id'])) {
                
                        foreach ($_POST['xsell_id'] as $temp) {
                            $data_cms = $_GET['add_related_article_ID'];
                            $data_xsell = $temp;
                            
//                            $data = array('cms_id' => $_GET['add_related_article_ID'],
//                                          'xsell_id' => $temp);                        
//                        print_r($temp);
                        
                            if ( !osC_cms_Admin::xsell_update($data_cms, $data_xsell)) {
                                $osC_MessageStack->add($this->_module, $osC_Language->get('ms_error_action_not_performed') . "-> " . $data_xsell, 'error');
                                $error = true;
                            }
                        }
                }        
                
                if ( $error === false ) {
                    $osC_MessageStack->add($this->_module, $osC_Language->get('ms_success_action_performed'), 'success');
                    osc_redirect_admin(osc_href_link_admin(FILENAME_DEFAULT, $this->_module .
                    '&action=xsell'));
                }
                
            }   
            
            break;

        }

     }  
    }
  }
?>
