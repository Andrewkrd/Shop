<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
  
    -----------------------------
    Module Currencies v. 1.01
	for osCommerce 3.0
	-----------------------------
	Author by Alexander Kholodov
	02.02.2011
	E-mail: micromail@mail.ru
	http://oscommerce-3.spb.ru
	ICQ 264957087
	Category: Paid
	-----------------------------
*/

  function quote_oanda_currency($code, $base = DEFAULT_CURRENCY) {
    $page = file('http://www.oanda.com/convert/fxdaily?value=1&redirected=1&exch=' . $code .  '&format=CSV&dest=Get+Table&sel_list=' . $base);

    $match = array();

    preg_match('/(.+),(\w{3}),([0-9.]+),([0-9.]+)/i', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[3];
    } else {
      return false;
    }
  }

  function quote_cbr_currency($cod, $bas = DEFAULT_CURRENCY) {
      global $quote_cbr_cash;
      if (sizeof($quote_cbr_cash)==0){
      $quote_cbr_cash = array();
      $quote_cbr_cash['RUB'] = 1.00;
      $quote_cbr_cash['RUR'] = 1.00;
      $page = file('http://www.cbr.ru/scripts/XML_daily.asp');
      if (!is_array($page)){
        return false;
      }
      $page = implode('', $page);
      preg_match_all("|<CharCode>(.*?)</CharCode>|is", $page, $m);
      preg_match_all("|<Value>(.*?)</Value>|is", $page, $c);
      preg_match_all("|<Nominal>(.*?)</Nominal>|is", $page, $nom);
      foreach ($m[1] as $kv => $mv){
      $quote_cbr_cash[$mv]=preg_replace('/,/', '/./', $c[1][$kv]);
	  $quote_cbr_cash[$mv]=$quote_cbr_cash[$mv]/$nom[1][$kv];
     }
    }
      if (isset($quote_cbr_cash[$cod]) && isset($quote_cbr_cash[$bas])) {
      $retval = round($quote_cbr_cash[$bas]/$quote_cbr_cash[$cod],8);
      settype($retval,"string");
      return $retval;
    } else {
      return false;
    }
  }
  
    function quote_nbu_currency($cod, $bas = DEFAULT_CURRENCY) {
      global $quote_nbu_cash;
      if (sizeof($quote_nbu_cash)==0){
      $quote_nbu_cash = array();
      $quote_nbu_cash['UAH'] = 1.00;
      $page = file('http://www.bank-ua.com/export/currrate.xml');
      if (!is_array($page)){
        return false;
      }
      $page = implode('', $page);
      preg_match_all("|<Char3>(.*?)</Char3>|is", $page, $m);
      preg_match_all("|<rate>(.*?)</rate>|is", $page, $c);
      preg_match_all("|<size>(.*?)</size>|is", $page, $nom);
      foreach ($m[1] as $kv => $mv){
      $quote_nbu_cash[$mv]=preg_replace('/,/', '/./', $c[1][$kv]);
	  $quote_nbu_cash[$mv]=$quote_nbu_cash[$mv]/$nom[1][$kv];
     }
    }
      if (isset($quote_nbu_cash[$cod]) && isset($quote_nbu_cash[$bas])) {
      $retval = round($quote_nbu_cash[$bas]/$quote_nbu_cash[$cod],8);
      settype($retval,"string");
      return $retval;
    } else {
      return false;
    }
  }
  
    function quote_bnm_currency($cod, $bas = DEFAULT_CURRENCY) {
      global $quote_bnm_cash;

      if (sizeof($quote_bnm_cash)==0){
      $quote_bnm_cash = array();
      $quote_bnm_cash['MDL'] = 1.00;
      $page = file('http://www.bnm.md/md/official_exchange_rates?get_xml=1&date='.date('d.m.Y'));
      if (!is_array($page)){
        return false;
      }
      $page = implode('', $page);
      preg_match_all("|<CharCode>(.*?)</CharCode>|is", $page, $m);
      preg_match_all("|<Value>(.*?)</Value>|is", $page, $c);
      preg_match_all("|<Nominal>(.*?)</Nominal>|is", $page, $nom);
      foreach ($m[1] as $kv => $mv){
      $quote_bnm_cash[$mv]=preg_replace('/,/', '/./', $c[1][$kv]);
	  $quote_bnm_cash[$mv]=$quote_bnm_cash[$mv]/$nom[1][$kv];
     }
    }
      if (isset($quote_bnm_cash[$cod]) && isset($quote_bnm_cash[$bas])) {
      $retval = round($quote_bnm_cash[$bas]/$quote_bnm_cash[$cod],8);
      settype($retval,"string");
      return $retval;
    } else {
      return false;
    }
  }
  
      function quote_nbrb_currency($cod, $bas = DEFAULT_CURRENCY) {
      global $quote_nbrb_cash;

      if (sizeof($quote_nbrb_cash)==0){
      $quote_nbrb_cash = array();
      $quote_nbrb_cash['BYR'] = 1.00;
      $page = file('http://www.nbrb.by/Services/XmlExRates.aspx?ondate='.date('d/m/Y'));
      if (!is_array($page)){
        return false;
      }
      $page = implode('', $page);
      preg_match_all("|<CharCode>(.*?)</CharCode>|is", $page, $m);
      preg_match_all("|<Rate>(.*?)</Rate>|is", $page, $c);
      preg_match_all("|<Scale>(.*?)</Scale>|is", $page, $nom);
      foreach ($m[1] as $kv => $mv){
      $quote_nbrb_cash[$mv]=preg_replace('/,/', '/./', $c[1][$kv]);
	  $quote_nbrb_cash[$mv]=$quote_nbrb_cash[$mv]/$nom[1][$kv];
     }
    }
      if (isset($quote_nbrb_cash[$cod]) && isset($quote_nbrb_cash[$bas])) {
      $retval = round($quote_nbrb_cash[$bas]/$quote_nbrb_cash[$cod],8);
      settype($retval,"string");
      return $retval;
    } else {
      return false;
    }
  }
  
  function quote_xe_currency($to, $from = DEFAULT_CURRENCY) {
    $page = file('http://www.xe.net/ucc/convert.cgi?Amount=1&From=' . $from . '&To=' . $to);

    $match = array();

    preg_match('/[0-9.]+\s*' . $from . '\s*=\s*([0-9.]+)\s*' . $to . '/', implode('', $page), $match);

    if (sizeof($match) > 0) {
      return $match[1];
    } else {
      return false;
    }
  }
?>
