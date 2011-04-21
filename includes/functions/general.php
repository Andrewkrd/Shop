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

/**
 * Redirect to a URL address
 *
 * @param string $url The URL address to redirect to
 * @access public
 */

  function osc_redirect($url) {
    global $osC_Services;

    if ( ( strpos($url, "\n") !== false ) || ( strpos($url, "\r") !== false ) ) {
      $url = osc_href_link(FILENAME_DEFAULT, null, 'NONSSL', false);
    }

    if ( strpos($url, '&amp;') !== false ) {
      $url = str_replace('&amp;', '&', $url);
    }

    header('Location: ' . $url);

    if ( isset($osC_Services) && is_a($osC_Services, 'osC_Services') ) {
      $osC_Services->stopServices();
    }

    exit;
  }

/**
 * Parse and output a user submited value
 *
 * @param string $string The string to parse and output
 * @param array $translate An array containing the characters to parse
 * @access public
 */

  function osc_output_string($string, $translate = null) {
    if (empty($translate)) {
      $translate = array('"' => '&quot;');
    }

    return strtr(trim($string), $translate);
  }

/**
 * Strictly parse and output a user submited value
 *
 * @param string $string The string to strictly parse and output
 * @access public
 */

  function osc_output_string_protected($string) {
    return htmlspecialchars(trim($string));
  }

/**
 * Sanitize a user submited value
 *
 * @param string $string The string to sanitize
 * @access public
 */

  function osc_sanitize_string($string) {
    $string = preg_replace('/ +/', ' ', trim($string));//$string = ereg_replace(' +', ' ', trim($string));

    return preg_replace("/[<>]/", '_', $string);
  }

/**
 * Get all parameters in the GET scope
 *
 * @param array $exclude A list of parameters to exclude
 * @access public
 */

  function osc_get_all_get_params($exclude = null) {
    global $osC_Session;

    $params = '';

    $array = array($osC_Session->getName(),
                   'error',
                   'x',
                   'y');

    if (is_array($exclude)) {
      foreach ($exclude as $key) {
        if (!in_array($key, $array)) {
          $array[] = $key;
        }
      }
    }

    if (isset($_GET) && !empty($_GET)) {
      foreach ($_GET as $key => $value) {
        if (!in_array($key, $array)) {
          $params .= $key . (!empty($value) ? '=' . $value : '') . '&';
        }
      }

      $params = substr($params, 0, -1);
    }

    return $params;
  }

/**
 * Round a number with the wanted precision
 *
 * @param float $number The number to round
 * @param int $precision The precision to use for the rounding
 * @access public
 */

  function osc_round($number, $precision) {
    if ( (strpos($number, '.') !== false) && (strlen(substr($number, strpos($number, '.')+1)) > $precision) ) {
      $number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);

      if (substr($number, -1) >= 5) {
        if ($precision > 1) {
          $number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
        } elseif ($precision == 1) {
          $number = substr($number, 0, -1) + 0.1;
        } else {
          $number = substr($number, 0, -1) + 1;
        }
      } else {
        $number = substr($number, 0, -1);
      }
    }

    return $number;
  }

/**
 * Create a sort heading with appropriate sort link
 *
 * @param string $key The key used for sorting
 * @param string $heading The heading to use the link on
 * @access public
 */

  function osc_create_sort_heading($key, $heading) {
    global $osC_Language;

    $current = false;
    $direction = false;

    if (!isset($_GET['sort'])) {
      $current = 'name';
    } elseif (($_GET['sort'] == $key) || ($_GET['sort'] == $key . '|d')) {
      $current = $key;
    }

    if ($key == $current) {
      if (isset($_GET['sort'])) {
        $direction = ($_GET['sort'] == $key) ? '+' : '-';
      } else {
        $direction = '+';
      }
    }

    return osc_link_object(osc_href_link(basename($_SERVER['SCRIPT_FILENAME']), osc_get_all_get_params(array('page', 'sort')) . '&sort=' . $key . ($direction == '+' ? '|d' : '')), $heading . (($key == $current) ? $direction : ''), 'title="' . (isset($_GET['sort']) && ($_GET['sort'] == $key) ? sprintf($osC_Language->get('listing_sort_ascendingly'), $heading) : sprintf($osC_Language->get('listing_sort_descendingly'), $heading)) . '"');
  }

/**
 * Generate a product ID string value containing its product attributes combinations
 *
 * @param string $id The product ID
 * @param array $params An array of product attributes
 * @access public
 */

  function osc_get_product_id_string($id, $params) {
    $string = (int)$id;

    if (is_array($params) && !empty($params)) {
      $attributes_check = true;
      $attributes_ids = array();

      foreach ($params as $option => $value) {
        if (is_numeric($option) && is_numeric($value)) {
          $attributes_ids[] = (int)$option . ':' . (int)$value;
        } else {
          $attributes_check = false;
          break;
        }
      }

      if ($attributes_check === true) {
        $string .= '#' . implode(';', $attributes_ids);
      }
    }

    return $string;
  }

/**
 * Generate a numeric product ID without product attribute combinations
 *
 * @param string $id The product ID
 * @access public
 */

  function osc_get_product_id($id) {
    if (is_numeric($id)) {
      return $id;
    }

    $product = explode('#', $id, 2);

    return (int)$product[0];
  }

/**
 * Send an email
 *
 * @param string $to_name The name of the recipient
 * @param string $to_email_address The email address of the recipient
 * @param string $subject The subject of the email
 * @param string $body The body text of the email
 * @param string $from_name The name of the sender
 * @param string $from_email_address The email address of the sender
 * @access public
 */

  function osc_email($to_name, $to_email_address, $subject, $body, $from_name, $from_email_address) {
    if (SEND_EMAILS == '-1') {
      return false;
    }

    $osC_Mail = new osC_Mail($to_name, $to_email_address, $from_name, $from_email_address, $subject);
    $osC_Mail->setBodyPlain($body);
    $osC_Mail->send();
  }

/**
 * Create a random string
 *
 * @param int $length The length of the random string to create
 * @param string $type The type of random string to create (mixed, chars, digits)
 * @access public
 */

  function osc_create_random_string($length, $type = 'mixed') {
    if (!in_array($type, array('mixed', 'chars', 'digits'))) {
      return false;
    }

    $chars_pattern = 'abcdefghijklmnopqrstuvwxyz';
    $mixed_pattern = '1234567890' . $chars_pattern;

    $rand_value = '';

    while (strlen($rand_value) < $length) {
      if ($type == 'digits') {
        $rand_value .= osc_rand(0,9);
      } elseif ($type == 'chars') {
        $rand_value .= substr($chars_pattern, osc_rand(0, 25), 1);
      } else {
        $rand_value .= substr($mixed_pattern, osc_rand(0, 35), 1);
      }
    }

    return $rand_value;
  }

/**
 * Alias function for empty()
 *
 * @param mixed $value The object to check if it is empty or not
 * @access public
 */

  function osc_empty($value) {
    return empty($value);
  }

/**
 * Generate a random number
 *
 * @param int $min The minimum number to return
 * @param int $max The maxmimum number to return
 * @access public
 */

  function osc_rand($min = null, $max = null) {
    static $seeded;

    if (!isset($seeded)) {
      if (version_compare(PHP_VERSION, '4.2', '<')) {
        mt_srand((double)microtime()*1000000);
      }

      $seeded = true;
    }

    if (is_numeric($min) && is_numeric($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

/**
 * Set a cookie
 *
 * @param string $name The name of the cookie
 * @param string $value The value of the cookie
 * @param int $expire Unix timestamp of when the cookie should expire
 * @param string $path The path on the server for which the cookie will be available on
 * @param string $domain The The domain that the cookie is available on
 * @param boolean $secure Indicates whether the cookie should only be sent over a secure HTTPS connection
 * @param boolean $httpOnly Indicates whether the cookie should only accessible over the HTTP protocol
 * @access public
 */

  function osc_setcookie($name, $value = null, $expires = 0, $path = null, $domain = null, $secure = false, $httpOnly = false) {
    global $request_type;

    if (empty($path)) {
      $path = ($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH;
    }

    if (empty($domain)) {
      $domain = ($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN;
    }

    header('Set-Cookie: ' . $name . '=' . urlencode($value) . '; expires=' . date('D, d-M-Y H:i:s T', $expires) . '; path=' . $path . '; domain=' . $domain . (($secure === true) ? ' secure;' : '') . (($httpOnly === true) ? ' httponly;' : ''));
  }

/**
 * Get the IP address of the client
 *
 * @access public
 */

function osc_get_ip_address() {
if (isset($_SERVER)) {
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
} else {
  if (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('HTTP_CLIENT_IP')) {
    $ip = getenv('HTTP_CLIENT_IP');
  } else {
    $ip = getenv('REMOTE_ADDR');
  }
}
//	Look at $ip, and see if it's actually an IP.
if ( preg_match('/^(?:\d{1,3}\.){3}\d{1,3}$/', $ip) === 1 )
{
	return $ip;
}
//	If we're here, then the environment variables didn't return something that can be used as an IP.
//	First, see if it's a list of IPs: split on non-IP characters.
$iparray = preg_split('/[^0-9\.]+/', $ip);
//	Now search for the first element in the array which is a publicly-routable IP address.
//	I have seen "unknown" and other nonsense in my access logs in place of IP addresses;
//	make sure we don't return any of those.
foreach ( $iparray as $ipaddr )
{
	if ( preg_match('/^(?:\d{1,3}\.){3}\d{1,3}$/', $ipaddr) === 1 )
	{
		//	Possible IP address. Publicly routable?
		$ipoctets = preg_split('/\./', $ipaddr);
		if ( count($ipoctets) === 4 )
		{
			//	e.g. RFC 1918.
			if ( $ipoctets[0] != 10 && !($ipoctets[0] == 172 && $ipoctets[1] >= 16 && $ipoctets[1] <= 31) && !($ipoctets[0] == 192 && $ipoctets[1] == 168) && !($ipoctets[0] == 127 && $ipoctets[1] == 0 && $ipoctets[2] == 0 && $ipoctets[3] == 1) && $ipoctets[0] <= 254 && $ipoctets[1] <= 254 && $ipoctets[2] <= 254 && $ipoctets[3] <= 254 )
			{
				return $ipaddr;
			}
		}
	}
}
//	None found. Return something.
return '0.0.0.0';

	
// Where proxy servers are involved multiple IP
// addresses can be returned. The first IP in the list
// should be the client IP 
    if (stristr($ip, ',') === true) {
      $arrip = explode(',', $ip);
      $ip = trim($arrip[0]);
    }

    return $ip;
  }

/**
 * Encrypt a string
 *
 * @param string $plain The string to encrypt
 * @access public
 */

  function osc_encrypt_string($plain) {
    $password = '';

    for ($i=0; $i<10; $i++) {
      $password .= osc_rand();
    }

    $salt = substr(md5($password), 0, 2);

    $password = md5($salt . $plain) . ':' . $salt;

    return $password;
  }

/**
 * Validates the format of an email address
 *
 * @param string $email_address The email address to validate
 * @access public
 */

  function osc_validate_email_address($email_address) {
    $valid_address = true;

    $mail_pat = '/^(.+)@(.+)$/i';//$mail_pat = '^(.+)@(.+)$';
    $valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
    $atom = "$valid_chars+";
    $quoted_user='(\"[^\"]*\")';
    $word = "($atom|$quoted_user)";
    $user_pat = "/^$word(\.$word)*$/i";//$user_pat = "^$word(\.$word)*$";
    $ip_domain_pat='/^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$/i';//$ip_domain_pat='^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
    $domain_pat = "/^$atom(\.$atom)*$/i";//$domain_pat = "^$atom(\.$atom)*$";

    if (preg_match($mail_pat, $email_address, $components)) {//if (eregi($mail_pat, $email_address, $components)) {
      $user = $components[1];
      $domain = $components[2];
// validate user
      if (preg_match($user_pat, $user)) {//if (eregi($user_pat, $user)) {
// validate domain
        if (preg_match($ip_domain_pat, $domain, $ip_components)) {//if (eregi($ip_domain_pat, $domain, $ip_components)) {
// this is an IP address
          for ($i=1;$i<=4;$i++) {
            if ($ip_components[$i] > 255) {
              $valid_address = false;
              break;
            }
          }
        } else {
// Domain is a name, not an IP
          if (preg_match($domain_pat, $domain)) {//if (eregi($domain_pat, $domain)) {
// domain name seems valid, but now make sure that it ends in a valid TLD or ccTLD and that there's a hostname preceding the domain or country.
            $domain_components = explode(".", $domain);
// Make sure there's a host name preceding the domain.
            if (sizeof($domain_components) < 2) {
              $valid_address = false;
            } else {
              $top_level_domain = strtolower($domain_components[sizeof($domain_components)-1]);
// Allow all 2-letter TLDs (ccTLDs)
              if (preg_match('/^[a-z][a-z]$/i', $top_level_domain) != 1) {//if (eregi('^[a-z][a-z]$', $top_level_domain) != 1) {
                $tld_pattern = '';
// Get authorized TLDs from text file
                $tlds = file(DIR_FS_CATALOG . 'includes/tld.txt');
                while (list(,$line) = each($tlds)) {
// Get rid of comments
                  $words = explode('#', $line);
                  $tld = trim($words[0]);
// TLDs should be 3 letters or more
                  if (preg_match('/^[a-z]{3,}$/i', $tld) == 1) {//if (eregi('^[a-z]{3,}$', $tld) == 1) {
                    $tld_pattern .= '^' . $tld . '$|';
                  }
                }
// Remove last '|'
                $tld_pattern = substr($tld_pattern, 0, -1);
                if (preg_match('/' . $tld_pattern . '/i', $top_level_domain) == 0) {//if (eregi("$tld_pattern", $top_level_domain) == 0) {
                  $valid_address = false;
                }
              }
            }
          } else {
            $valid_address = false;
          }
        }
      } else {
        $valid_address = false;
      }
    } else {
      $valid_address = false;
    }

    if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == '1') {
      if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
        $valid_address = false;
      }
    }

    return $valid_address;
  }

/**
 * Sets the defined locale
 *
 * @param string $category The category of the locale to set
 * @param mixed $locale The locale, or an array of locales to try and set
 * @access public
 */

  function osc_setlocale($category, $locale) {
    if (version_compare(PHP_VERSION, '4.3', '<')) {
      if (is_array($locale)) {
        foreach ($locale as $l) {
          if (($result = setlocale($category, $l)) !== false) {
            return $result;
          }
        }

        return false;
      } else {
        return setlocale($category, $locale);
      }
    } else {
      return setlocale($category, $locale);
    }
  }
?>
