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

/**
 * The osC_Template class defines or adds elements to the page output such as the page title, page content, and javascript blocks
 */

  class osC_Template {

/**
 * Holds the template name value
 *
 * @var string
 * @access protected
 */

    protected $_template;

/**
 * Holds the template ID value
 *
 * @var int
 * @access protected
 */

    protected $_template_id;

/**
 * Holds the title of the page module
 *
 * @var string
 * @access protected
 */

    protected $_module;

/**
 * Holds the group name of the page
 *
 * @var string
 * @access protected
 */

    protected $_group;

/**
 * Holds the title of the page
 *
 * @var string
 * @access protected
 */

    protected $_page_title;

/**
 * Holds the image of the page
 *
 * @var string
 * @access protected
 */

    protected $_page_image;

/**
 * Holds the filename of the content to be added to the page
 *
 * @var string
 * @access protected
 */

    protected $_page_contents;

/**
 * Holds the meta tags of the page
 *
 * @var array
 * @access protected
 */

    protected $_page_tags = array('generator' => array('osCommerce, Open Source E-Commerce Solutions'));

/**
 * Holds javascript filenames to be included in the page
 *
 * The javascript files must be plain javascript files without any PHP logic, and are linked to from the page
 *
 * @var array
 * @access protected
 */

    protected $_javascript_filenames = array('includes/general.js');

/**
 * Holds javascript PHP filenames to be included in the page
 *
 * The javascript PHP filenames can consist of PHP logic to produce valid javascript syntax, and is embedded in the page
 *
 * @var array
 * @access protected
 */

    protected $_javascript_php_filenames = array();

/**
 * Holds blocks of javascript syntax to embedd into the page
 *
 * Each block must contain its relevant <script> and </script> tags
 *
 * @var array
 * @access protected
 */

    protected $_javascript_blocks = array();

/**
 * Defines if the requested page has a header
 *
 * @var boolean
 * @access protected
 */

    protected $_has_header = true;

/**
 * Defines if the requested page has a footer
 *
 * @var boolean
 * @access protected
 */

    protected $_has_footer = true;

/**
 * Defines if the requested page has box modules
 *
 * @var boolean
 * @access protected
 */

    protected $_has_box_modules = true;

/**
 * Defines if the requested page has content modules
 *
 * @var boolean
 * @access protected
 */

    protected $_has_content_modules = true;

/**
 * Defines if the requested page should display any debug messages
 *
 * @var boolean
 * @access protected
 */

    protected $_show_debug_messages = true;

/**
 * Setup the template class with the requested page module
 *
 * @param string $module The default page module to setup
 * @return object
 */

    function &setup($module) {
      $group = basename($_SERVER['SCRIPT_FILENAME']);

      if (($pos = strrpos($group, '.')) !== false) {
        $group = substr($group, 0, $pos);
      }

      if (empty($_GET) === false) {
        $first_array = array_slice($_GET, 0, 1);
        $_module = osc_sanitize_string(basename(key($first_array)));

        if (file_exists('includes/content/' . $group . '/' . $_module . '.php')) {
          $module = $_module;
        }
      }

      include('includes/content/' . $group . '/' . $module . '.php');

      $_page_module_name = 'osC_' . ucfirst($group) . '_' . ucfirst($module);
      $object = new $_page_module_name();

      if ( isset($_GET['action']) && !empty($_GET['action']) ) {
        include('includes/classes/actions.php');

        osC_Actions::parse($_GET['action']);
      }

      return $object;
    }

/**
 * Returns the template ID
 *
 * @access public
 * @return int
 */

    function getID() {
      if (isset($this->_template) === false) {
        $this->set();
      }

      return $this->_template_id;
    }

/**
 * Returns the template name
 *
 * @access public
 * @return string
 */

    function getCode($id = null) {
      if (isset($this->_template) === false) {
        $this->set();
      }

      if (is_numeric($id)) {
        foreach ($this->getTemplates() as $template) {
          if ($template['id'] == $id) {
            return $template['code'];
          }
        }
      } else {
        return $this->_template;
      }
    }

/**
 * Returns the page module name
 *
 * @access public
 * @return string
 */

    function getModule() {
      return $this->_module;
    }

/**
 * Returns the page group name
 *
 * @access public
 * @return string
 */

    function getGroup() {
      return $this->_group;
    }

/**
 * Returns the title of the page
 *
 * @access public
 * @return string
 */

    function getPageTitle() {
      return osc_output_string_protected($this->_page_title);
    }

/**
 * Returns the tags of the page separated by a comma
 *
 * @access public
 * @return string
 */

    function getPageTags() {
      $tag_string = '';

      foreach ($this->_page_tags as $key => $values) {
        $tag_string .= '<meta name="' . $key . '" content="' . implode(', ', $values) . '" />' . "\n";
      }

      return $tag_string . "\n";
    }

/**
 * Return the box modules assigned to the page
 *
 * @param string $group The group name of box modules to include that the template has provided
 * @return array
 */

    function getBoxModules($group) {
      if (isset($this->osC_Modules_Boxes) === false) {
        $this->osC_Modules_Boxes = new osC_Modules('boxes');
      }

      return $this->osC_Modules_Boxes->getGroup($group);
    }

/**
 * Return the content modules assigned to the page
 *
 * @param string $group The group name of content modules to include that the template has provided
 * @return array
 */

    function getContentModules($group) {
      if (isset($this->osC_Modules_Content) === false) {
        $this->osC_Modules_Content = new osC_Modules('content');
      }

      return $this->osC_Modules_Content->getGroup($group);
    }

/**
 * Returns the image of the page
 *
 * @access public
 * @return string
 */

    function getPageImage() {
      return $this->_page_image;
    }

/**
 * Returns the content filename of the page
 *
 * @access public
 * @return string
 */

    function getPageContentsFilename() {
      return $this->_page_contents;
    }

/**
 * Returns the javascript to link from or embedd to on the page
 *
 * @access public
 * @return string
 */

    function getJavascript() {
      if (!empty($this->_javascript_filenames)) {
        echo $this->_getJavascriptFilenames();
      }

      if (!empty($this->_javascript_php_filenames)) {
        $this->_getJavascriptPhpFilenames();
      }

      if (!empty($this->_javascript_blocks)) {
        echo $this->_getJavascriptBlocks();
      }
    }

/**
 * Return all templates in an array
 *
 * @access public
 * @return array
 */

    function &getTemplates() {
      global $osC_Database;

      $templates = array();

      $Qtemplates = $osC_Database->query('select id, code, title from :table_templates');
      $Qtemplates->bindTable(':table_templates', TABLE_TEMPLATES);
      $Qtemplates->setCache('templates');
      $Qtemplates->execute();

      while ($Qtemplates->next()) {
        $templates[] = $Qtemplates->toArray();
      }

      $Qtemplates->freeResult();

      return $templates;
    }

/**
 * Checks to see if the page has a title set
 *
 * @access public
 * @return boolean
 */

    function hasPageTitle() {
      return !empty($this->_page_title);
    }

/**
 * Checks to see if the page has a meta tag set
 *
 * @access public
 * @return boolean
 */

    function hasPageTags() {
      return !empty($this->_page_tags);
    }

/**
 * Checks to see if the page has javascript to link to or embedd from
 *
 * @access public
 * @return boolean
 */

    function hasJavascript() {
      return (!empty($this->_javascript_filenames) || !empty($this->_javascript_php_filenames) || !empty($this->_javascript_blocks));
    }

/**
 * Checks to see if the page has a footer defined
 *
 * @access public
 * @return boolean
 */

    function hasPageFooter() {
      return $this->_has_footer;
    }

/**
 * Checks to see if the page has a header defined
 *
 * @access public
 * @return boolean
 */

    function hasPageHeader() {
      return $this->_has_header;
    }

/**
 * Checks to see if the page has content modules defined
 *
 * @access public
 * @return boolean
 */

    function hasPageContentModules() {
      return $this->_has_content_modules;
    }

/**
 * Checks to see if the page has box modules defined
 *
 * @access public
 * @return boolean
 */

    function hasPageBoxModules() {
      return $this->_has_box_modules;
    }

/**
 * Checks to see if the page show display debug messages
 *
 * @access public
 * @return boolean
 */

    function showDebugMessages() {
      return $this->_show_debug_messages;
    }

/**
 * Sets the template to use
 *
 * @param string $code The code of the template to use
 * @access public
 */

    function set($code = null) {
      if ( (isset($_SESSION['template']) === false) || !empty($code) || (isset($_GET['template']) && !empty($_GET['template'])) ) {
        if ( !empty( $code ) ) {
          $set_template = $code;
        } else {
          $set_template = (isset($_GET['template']) && !empty($_GET['template'])) ? $_GET['template'] : DEFAULT_TEMPLATE;
        }

        $data = array();
        $data_default = array();

        foreach ($this->getTemplates() as $template) {
          if ($template['code'] == DEFAULT_TEMPLATE) {
            $data_default = array('id' => $template['id'], 'code' => $template['code']);
          } elseif ($template['code'] == $set_template) {
            $data = array('id' => $template['id'], 'code' => $template['code']);
          }
        }

        if (empty($data)) {
          $data =& $data_default;
        }

        $_SESSION['template'] =& $data;
      }

      $this->_template_id =& $_SESSION['template']['id'];
      $this->_template =& $_SESSION['template']['code'];
    }

/**
 * Sets the title of the page
 *
 * @param string $title The title of the page to set to
 * @access public
 */

    function setPageTitle($title) {
      $this->_page_title = $title;
    }

/**
 * Sets the image of the page
 *
 * @param string $image The image of the page to set to
 * @access public
 */

    function setPageImage($image) {
      $this->_page_image = $image;
    }

/**
 * Sets the content of the page
 *
 * @param string $filename The content filename to include on the page
 * @access public
 */

    function setPageContentsFilename($filename) {
      $this->_page_contents = $filename;
    }

/**
 * Adds a tag to the meta keywords array
 *
 * @param string $key The keyword for the meta tag
 * @param string $value The value for the meta tag using the key
 * @access public
 */

    function addPageTags($key, $value) {
      $this->_page_tags[$key][] = $value;
    }

/**
 * Adds a javascript file to link to
 *
 * @param string $filename The javascript filename to link to
 * @access public
 */

    function addJavascriptFilename($filename) {
      $this->_javascript_filenames[] = $filename;
    }

/**
 * Adds a PHP based javascript file to embedd on the page
 *
 * @param string $filename The PHP based javascript filename to embedd
 * @access public
 */

    function addJavascriptPhpFilename($filename) {
      $this->_javascript_php_filenames[] = $filename;
    }

/**
 * Adds javascript logic to the page
 *
 * @param string $javascript The javascript block to add on the page
 * @access public
 */

    function addJavascriptBlock($javascript) {
      $this->_javascript_blocks[] = $javascript;
    }

/**
 * Returns the javascript filenames to link to on the page
 *
 * @access private
 * @return string
 */

    function _getJavascriptFilenames() {
      $js_files = '';

      foreach ($this->_javascript_filenames as $filenames) {
        $js_files .= '<script language="javascript" type="text/javascript" src="' . $filenames . '"></script>' . "\n";
      }

      return $js_files;
    }

/**
 * Returns the PHP javascript files to embedd on the page
 *
 * @access private
 */

    function _getJavascriptPhpFilenames() {
      foreach ($this->_javascript_php_filenames as $filenames) {
        include($filenames);
      }
    }

/**
 * Returns javascript blocks to add to the page
 *
 * @access private
 * @return string
 */

    function _getJavascriptBlocks() {
      return implode("\n", $this->_javascript_blocks);
    }
	/**
 * Outputs an image submit template button
 *
 * @param string $image The image filename to display
 * @param string $title The title of the image button
 * @param string $parameters Additional parameters for the image submit button
 * @access public
 */
 
    function osc_draw_image_submit_template_button($image, $title = null, $parameters = null) {
     global $osC_Language;

     $image_submit = '<input type="image" src="' . osc_output_string('templates/'. $this->getCode() . '/languages/' . $osC_Language->getCode() . '/images/buttons/' . $image) . '"';

     if (!empty($title)) {
       $image_submit .= ' alt="' . osc_output_string($title) . '" title="' . osc_output_string($title) . '"';
     }

     if (!empty($parameters)) {
       $image_submit .= ' ' . $parameters;
     }

     $image_submit .= ' />';

    return $image_submit;
  }

    function osc_draw_images_button($image, $title = null, $parameters = null) {
     global $osC_Language;

     $images_button = '<input type="image" src="' . osc_output_string('templates/'. $this->getCode() . '/images/' . $image) . '"';

     if (!empty($title)) {
       $images_button .= ' alt="' . osc_output_string($title) . '" title="' . osc_output_string($title) . '"';
     }

     if (!empty($parameters)) {
       $images_button .= ' ' . $parameters;
     }

     $images_button .= ' />';

    return $images_button;
  }
/**
 * Outputs an image template button
 *
 * @param string $image The image filename to display
 * @param string $title The title of the image button
 * @param string $parameters Additional parameters for the image button
 * @access public
 */

  function osc_draw_image_template_button($image, $title = null, $parameters = null) {
    global $osC_Language;

    return osc_image('templates/'. $this->getCode() . '/languages/' . $osC_Language->getCode() . '/images/buttons/' . $image, $title, null, null, $parameters);
  }

/* Generate a jQuery UI button */
  
  function osc_draw_image_jquery_button($params) {
    static $button_counter = 1;
      global $osC_Language;

      $types = array('submit', 'button', 'reset');

      if ( !isset($params['type']) ) {
        $params['type'] = 'submit';
      }

      if ( !in_array($params['type'], $types) ) {
        $params['type'] = 'submit';
      }

      if ( ($params['type'] == 'submit') && isset($params['href']) ) {
        $params['type'] = 'button';
      }

      $button = '<button id="button' . $button_counter . '" type="' . osc_output_string($params['type']) . '"';

      if ( isset($params['href']) ) {
        if ( isset($params['newwindow']) ) {
          $button .= ' onclick="window.open(\'' . $params['href'] . '\');"';
        } else {
          $button .= ' onclick="document.location.href=\'' . $params['href'] . '\';"';
        }
      }

      if ( isset($params['params']) ) {
        $button .= ' ' . $params['params'];
      }

      $button .= '>' . $params['title'] . '</button><script type="text/javascript">$("#button' . $button_counter . '").button(';

      if ( isset($params['icon']) ) {
        if ( !isset($params['iconpos']) ) {
          $params['iconpos'] = 'left';
        }

        if ( $params['iconpos'] == 'left' ) {
          $button .= '{icons:{primary:"ui-icon-' . $params['icon'] . '"}}';
        } else {
          $button .= '{icons:{secondary:"ui-icon-' . $params['icon'] . '"}}';
        }
      }

      $button .= ')';

      if ( isset($params['priority']) ) {
        $button .= '.addClass("ui-priority-' . $params['priority'] . '")';
      }

      $button .= ';</script>';

      $button_counter++;

      return $button;
    }
  }
?>
