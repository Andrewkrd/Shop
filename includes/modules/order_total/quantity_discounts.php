<?php
/*
  Quantity Discounts Contribution
  for osCommerce 3.0
  by That Software Guy  - www.thatsofwareguy.com

  If this program helps your store make money, please donate to support my work.
 
  http://donate.thatsoftwareguy.com

  For help on this program, see 
  http://www.thatsoftwareguy.com/osc_quantity_discounts.html
  or click "Help" in Admin->Modules->Order Total Modules->Quantity Discounts

  Determining category and product IDs in osCommerce 3: 

  a) Apply the modifications from "displaying product and category ids" 
     in the install instructions

  b) To determine a product id, go to Admin->Content->Products
     and look at the left hand side of the list.

  c) To determine a category id, go to Admin->Content->Categories 
     and look at the left hand side of the list.

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009, That Software Guy, Inc.
  Portions Copyright (c) 2006 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.

*/

  class osC_OrderTotal_quantity_discounts extends osC_OrderTotal {
    var $output;

    var $_title,
        $_code = 'quantity_discounts',
        $_status = false,
        $_sort_order;

    // Add categories you wish to exclude to this list.
    // See instructions at top of file for determining product/category id.
    // Note that 99999 and 99998 are just given as examples.
    function exclude_category($category) {
        switch($category) {
           case 99999:
           case 99998:
                return true;
        }
        return false;
    }

    // Add categories which are "linked" and should not be used as 
    // the "master category" to this list.
    // See instructions at top of file for determining product/category id.
    // Note that 99999 and 99998 are just given as examples.
    function is_linked_category($category) {
        switch($category) {
           case 99999:
           case 99998:
                return true;
        }
        return false;
    }

    // Add products you wish to exclude to this list.
    // See instructions at top of file for determining product/category id.
    // Note that 99999 and 99998 are just given as examples.
    function exclude_product($id) {
        switch($id) {
           case 3:  // Dymo
           case 99999:
           case 99998:
                return true;
        }
        return false;
    }

    // Add categories with special discounting policies to this list.
    // See instructions at top of file for determining product/category id.
    // Note that 99999, 99998 and 99997 are just given as examples.
    // Note that the Discounting Units you specified in Admin 
    // (percentage, currency, currency/item) are also used here.
    function apply_special_category_discount($category, $count, &$disc_amount) {
        switch($category) {
           case 99999:
           case 99998:
                if ($count > 100) {
                   $disc_amount = 50; 
                }
                break; 
           case 99997:
                $disc_amount = 75;
                break;
        }
    }

    // Add items with special discounting policies to this list.
    // See instructions at top of file for determining product/category id.
    // Note that 99999, 99998 and 99997 are just given as examples.
    // Note that the Discounting Units you specified in Admin 
    // (percentage, currency, currency/item) are also used here.
    function apply_special_item_discount($id, $count, &$disc_amount) {
        switch($id) {
           case 99999:
           case 99998:
                if ($count > 100) {
                   $disc_amount = 50; 
                }
                break; 
           case 99997:
                $disc_amount = 75;
                break; 
        }
    }

    function check() { 
      return $this->_status;
    }
    
    // c'tor
    function osC_OrderTotal_quantity_discounts() {
      global $osC_Language;

      $this->output = array();

      $this->_title = $osC_Language->get('order_total_quantity_discounts_title');
      $this->_description = $osC_Language->get('order_total_quantity_discounts_description');
      $this->_status = (defined('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS') && (MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_STATUS == '1') ? true : false);
      $this->_sort_order = (defined('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER') ? MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_SORT_ORDER : null);

      $this->include_tax = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_CALC_TAX;
      $this->total_basis = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_TOTAL_BASIS;
      $this->units = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_UNITS;
      $this->counting_method = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_COUNTING_METHOD;
      $this->total_level_1 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_1;
      $this->total_discount_1 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_1; 
      $this->total_level_2 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_2;
      $this->total_discount_2 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_2;
      $this->total_level_3 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_3;
      $this->total_discount_3 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_3;
      $this->total_level_4 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_4;
      $this->total_discount_4 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_4;
      $this->total_level_5 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_LEVEL_5; 
      $this->total_discount_5 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNTS_AMOUNT_5;
      $this->extra_levels = array(); 
      $this->setup_language(); 
      $this->setup(); 
    }

    function get_disc_amount($count) {
      $disc_amount = 0;
      if ($count >= $this->total_level_1) 
          $disc_amount = $this->total_discount_1;
      if ($count >= $this->total_level_2) 
          $disc_amount = max($disc_amount, $this->total_discount_2);
      if ($count >= $this->total_level_3) 
          $disc_amount = max($disc_amount, $this->total_discount_3);
      if ($count >= $this->total_level_4) 
          $disc_amount = max($disc_amount, $this->total_discount_4);
      if ($count >= $this->total_level_5) 
          $disc_amount = max($disc_amount, $this->total_discount_5);
      for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
          if ($count >= $this->extra_levels[$i]) {
             $disc_amount = max($disc_amount, $this->extra_discounts[$i]); 
          }
      }
      return $disc_amount; 
    }

    function get_tax_rate_from_desc($tax_desc) {
      global $osC_Database;
      $tax_rate = 0.00;
  
      $tax_descriptions = explode(' + ', $tax_desc);
      foreach ($tax_descriptions as $tax_description) {
        $Qtax = $osC_Database->query('select tax_rate from :table_tax_rates 
where tax_description = :tax_desc'); 
        $Qtax->bindTable(':table_tax_rates', TABLE_TAX_RATES);
        $Qtax->bindValue(':tax_desc', $tax_description);
        $Qtax->execute();

        if ($Qtax->numberOfRows()) {
           while ($Qtax->next()) {
              $tax_rate += $Qtax->valueInt('tax_rate');
           }
        }
      }
      return $tax_rate;
    }


    function is_discountable($products_id) {
       $products_id = (int) $products_id;
       $catlist = $this->get_catlist($products_id);
       foreach ($catlist as $cat) {
          if ($this->exclude_category($cat)) { 
              return false;
          }
       }
       if ($this->exclude_product($products_id)) return false;
       return true;
    }

    function get_master_category($products_id) {
       $products_id = (int) $products_id;
       $catlist = $this->get_catlist($products_id);

       $mcat = 0;
       foreach ($catlist as $cat) {
          // Assign the first category found as the product category
          $mcat = $cat;
          break;
       }
 
       // If the assigned category is a linked category, see if 
       // there's another one.
       reset($catlist); 
       if ($this->is_linked_category($mcat)) {
          foreach ($catlist as $cat) {
             // Use first non-linked category found 
             if (!$this->is_linked_category($cat)) {
                $mcat = $cat;
                break;
             }
          }
       }
       return $mcat;
    }

    function get_catlist($products_id) {
        global $osC_Database; 
        $catlist = array(); 
        $Qcats = $osC_Database->query("select p2c.categories_id from :table_products p, :table_products_to_categories  p2c where p.products_id = :products_id and p.products_status = '1' and p.products_id = p2c.products_id");
        $Qcats->bindTable(':table_products', TABLE_PRODUCTS);
        $Qcats->bindTable(':table_products_to_categories', TABLE_PRODUCTS_TO_CATEGORIES);
        $Qcats->bindInt(':products_id', $products_id);
        $Qcats->execute();

        if ($Qcats->numberOfRows()) {
           while ($Qcats->next()) {
              $catlist[] = $Qcats->valueInt('categories_id');
           }
        }
        return $catlist;
    }

    function cat_compatible($products_id, $id2) {
        global $osC_Database; 
        $catlist = array(); 
        $Qcats = $osC_Database->query("select p2c.categories_id from :table_products p, :table_products_to_categories  p2c where p.products_id = :products_id and p.products_status = '1' and p.products_id = p2c.products_id");
        $Qcats->bindTable(':table_products', TABLE_PRODUCTS);
        $Qcats->bindTable(':table_products_to_categories', TABLE_PRODUCTS_TO_CATEGORIES);
        $Qcats->bindInt(':products_id', $products_id);
        $Qcats->execute();

        if ($Qcats->numberOfRows()) {
           while ($Qcats->next()) {
              $thiscat  = $Qcats->valueInt('categories_id');
              if ($thiscat == $id2) return true; 
           }
        }
        return false; 
    }

    function get_category_name($cat_id) {
      global $osC_Language, $osC_Database;

      $Qcats = $osC_Database->query("select categories_name from :table_categories_desc where categories_id = :cat_id and language_id = :lang_id");
      $Qcats->bindTable(':table_categories_desc', TABLE_CATEGORIES_DESCRIPTION);
      $Qcats->bindTable(':lang_id', $osC_Language->getID()); 
      $Qcats->bindInt(':cat_id', $cat_id);
      $Qcats->execute();
      return $Qcats->value('categories_name'); 
    }

    function get_products_name($id) {
       global $osC_ShoppingCart; 
       $thisprod = new osC_Product($id); 
       $name = $thisprod->getTitle(); 
       /* 
       if ( $osC_ShoppingCart->isVariant($id) ) {
         $name .= " (";
         foreach ( $osC_ShoppingCart->getVariant($id) as $variant) {
           $name .= $variant['group_title'] . ': ' . $variant['value_title'];
         }
         $name .= ")";
       }
       */
       return $name;
    }

    function gross_up($net) {
       global $osC_Tax, $osC_ShoppingCart, $osC_Currencies;
       $gross_up_amt = 0; 
       if ($this->calculate_tax == 'Standard') { 
          foreach ($osC_ShoppingCart->getTaxGroups() as $key => $value) {
             $rate = $this->get_tax_rate_from_desc($key); 
             if ($rate > 0) { 
                $gross_up_amt += $osC_Tax->calculate($net, $rate);
             }
          }
       }
       return $gross_up_amt + $net; 
    }

    function calculate_deductions() {
       global $osC_Tax, $osC_ShoppingCart, $osC_Currencies;
       $od_amount = array();

       $product_list = $osC_ShoppingCart->getProducts(); 
       $prod_list = array();
       $prod_list_price = array();
       $cat_list = array();
       $cat_list_price = array();
       $all_items = 0;
       $cat_list_back = array();
       $prod_list_back = array(); 
       $all_items_price = 0;
       $products = array(); 
       foreach ($product_list as $product_item ) {
          $products[] = $product_item; 
       }
       for ($i=0, $n=sizeof($products); $i<$n; $i++) {

          $mprod = new osC_Product($products[$i]['id']);
          $prid = $mprod->getMasterID();

          if (!$this->is_discountable($prid))  continue; 

          $products[$i]['category'] = $this->get_master_category($prid); 
          $price = $products[$i]['price'];
          $quantity = $products[$i]['quantity'];

          // OK, it's an item you want to include.  Add it to the lists: 
          // by category
          $cat_list_back[$products[$i]['category']] = &$products[$i]; 
          if (!isset($cat_list[$products[$i]['category']])) {
             $cat_list[$products[$i]['category']] = $quantity; 
          } else { 
             $cat_list[$products[$i]['category']] += $quantity;
          }
          if (!isset($cat_list_price[$products[$i]['category']])) {
             $cat_list_price[$products[$i]['category']] = ($price * $quantity);
          } else { 
             $cat_list_price[$products[$i]['category']] += ($price * $quantity);
          }

          // by products
          $prod_list_back[$prid] = &$products[$i];
          if (!isset($prod_list[$prid])) { 
             $prod_list[$prid] = $quantity;
          } else { 
             $prod_list[$prid] += $quantity;
          }
          if (!isset($prod_list_price[$prid])) {
             $prod_list_price[$prid] = ($price * $quantity);
          } else { 
             $prod_list_price[$prid] += ($price * $quantity);
          }

          // by cart total
          $all_items += $quantity;
          $all_items_price += ($price * $quantity);
       }

       $cart_array = false;
       $key_list = array();
       if ($this->total_basis == '33') {
          $key_list = array_keys($cat_list); 
          $cart_array = true;
       } else if ($this->total_basis == '34') {
          $key_list = array_keys($prod_list); 
          $cart_array = true;
       } 

       $discount = 0;
       $this->explanation = $this->YOUR_CURRENT_QUANTITY_DISCOUNT . "\\n" . "\\n"; 

       if ($cart_array == true) {
          // Discount by category or item number
          while (list($keypos, $listpos) = each($key_list)) {
             if ($this->total_basis == '33') {
                $description = $this->get_category_name(
                       $cat_list_back[$listpos]['category']) . 
                       " " . $this->ITEMS;
                $count =  $cat_list[$listpos];
                $price =  $cat_list_price[$listpos];
                if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
                   $disc_amount = $this->get_disc_amount($count); 
                } else {
                   $disc_amount = $this->get_disc_amount($price); 
                }
                $this->apply_special_category_discount(
                       $listpos, $count, $disc_amount);
             } else { 
                // $description =  $prod_list_back[$listpos]['model'];
                $description =  $this->get_products_name($prod_list_back[$listpos]['id']);
                $count =  $prod_list[$listpos];
                $price =  $prod_list_price[$listpos];
                if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
                   $disc_amount = $this->get_disc_amount($count); 
                } else {
                   $disc_amount = $this->get_disc_amount($price); 
                }
                $this->apply_special_item_discount(
                       $listpos, $count, $disc_amount);
             }

             if ($disc_amount == 0)
                continue; 
              
             if ($this->units == '30') {
                $this_discount = $disc_amount; 
             } else if ($this->units == '32') {
                $this_discount = $disc_amount * $count; 
             } else  {
                $this_discount = $price * $disc_amount / 100;
             }

             // This is a discount, not a credit! :)
             if ($this_discount > $price)  {
                $this_discount = $price;
             }
             
             $this_discount_inc_tax = $this_discount; 
             if ($this->include_tax == '1') {
                $this_discount_inc_tax = $this->gross_up($this_discount); 
             }

             $discount +=  $this_discount_inc_tax;

             // Build the discount explanation text string 
             $gross_expl = "";
             if ($this->include_tax == '1') {
                  $gross_expl = "  (".$this->GROSSED_UP." = " . $this->print_amount($this_discount_inc_tax) . ")\\n"; 
             } 
             if ($this->units == '30') {
                $this->explanation .= " " . 
                   $this->print_amount($this_discount) . " " . $this->OFF . " " . 
                    $count . " " . 
                    $description . "@" .  
                   $this->print_amount($price) . $gross_expl . "\\n";
             } else if ($this->units == '32') {
                $this->explanation .= " " . 
                   $this->print_amount($disc_amount) . " " . $this->PER_ITEM_OFF . " " . 
                    $count . " " . 
                    $description . "@" .  
                   $this->print_amount($price) . $gross_expl . "\\n";
             } else {
                $this->explanation .=  " " . $count . " " . 
                   $description . "@" .  
                   $this->print_amount($price) . " * " . $disc_amount .  "% = " . 
                   $this->print_amount($this_discount) . $gross_expl . "\\n"; 
             } 
          }
       } else {
          $count = $all_items; 
          $price = $all_items_price; 
          if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
             $disc_amount = $this->get_disc_amount($count); 
          } else { 
             $disc_amount = $this->get_disc_amount($price); 
          }
          if ($this->units == '30') {
             $this_discount = $disc_amount; 
          } else if ($this->units == '32') {
             $this_discount = $disc_amount * $count; 
          } else  {
             $this_discount = $price * $disc_amount / 100;
          }
          if ($this_discount > $price)  {
             $this_discount = $price;
          }
          $this_discount_inc_tax = $this_discount; 
          if ($this->include_tax == '1') {
             $this_discount_inc_tax = $this->gross_up($this_discount); 
          }

          // Discount by cart total
          $discount =  $this_discount_inc_tax;
          $gross_expl = "";
          if ($this->include_tax == '1') {
             $gross_expl = "  (".$this->GROSSED_UP." = " . $this->print_amount($this_discount_inc_tax) . ")\\n"; 
          } 
          if ($this->units == '30') {
              $this->explanation .= " " . 
                      $this->print_amount($this_discount) . $this->OFF . 
                       $count . " " . 
                       $this->ITEMS . " @ " .  
                      $this->print_amount($price) . $gross_expl . "\\n";
          } else if ($this->units == '32') {
              $this->explanation .= " " . 
                      $this->print_amount($disc_amount) . $this->PER_ITEM_OFF . 
                       $count . " " . 
                       $this->ITEMS . " @ " .  
                      $this->print_amount($price) . $gross_expl . "\\n";
          } else {
              $this->explanation .=  " " . $count . " " . 
                      $this->ITEMS . " @ " .  
                      $this->print_amount($price) . " * " . $disc_amount .  "% = " . 
                      $this->print_amount($this_discount) . $gross_expl . "\\n"; 
          } 
       }
  
       $this->explanation .= "\\n\\n" . $this->TOTAL_DISCOUNT . $this->print_amount($discount); 
       return round($discount, 2); 
    }

    function process() {

      global $osC_Tax, $osC_ShoppingCart, $osC_Currencies;
      $pass = true;
      $discount = $this->calculate_deductions(); 
      $discount *= -1; 

      if ($this->calculate_tax == 'Standard') { 
         foreach ($osC_ShoppingCart->getTaxGroups() as $key => $value) {
            $rate = $this->get_tax_rate_from_desc($key); 
            $tax_cut = $osC_Tax->calculate($discount, $rate);
            $osC_ShoppingCart->addTaxAmount($tax_cut); 
            $osC_ShoppingCart->addTaxGroup($key, $tax_cut);
            $osC_ShoppingCart->addToTotal($tax_cut);
         }
      }
   
      $osC_ShoppingCart->addToTotal($discount);
      $this->output[] = array('title' => $this->_title . ':',
                                  'text' => $osC_Currencies->displayPrice($discount, 0),
                                  'value' => $discount);
    }

    function setup_language() { 
      global $osC_Language;

      $this->HEADER_QUANTITY =  $osC_Language->get('order_total_quantity_discounts_header_quantity');
      $this->HEADER_DISCOUNT=  $osC_Language->get('order_total_quantity_discounts_header_discount');
      $this->HEADER_AMOUNT_SPENT=  $osC_Language->get('order_total_quantity_discounts_header_amount_spent');
      $this->BUY =  $osC_Language->get('order_total_quantity_discounts_buy');
      $this->SPEND = $osC_Language->get('order_total_quantity_discounts_spend'); 
      $this->GET =  $osC_Language->get('order_total_quantity_discounts_get');
      $this->ITEMS =  $osC_Language->get('order_total_quantity_discounts_items');
      $this->BASIS_CATEGORY =  $osC_Language->get('order_total_quantity_discounts_basis_category');
      $this->BASIS_MANUFACTURER =  $osC_Language->get('order_total_quantity_discounts_basis_manufacturer');
      $this->BASIS_ITEM =  $osC_Language->get('order_total_quantity_discounts_basis_item');
      $this->BASIS_CART =  $osC_Language->get('order_total_quantity_discounts_basis_cart');
      $this->BASIS_DS_CATEGORY =  $osC_Language->get('order_total_quantity_discounts_basis_ds_category');
      $this->BASIS_DS_MANUFACTURER =  $osC_Language->get('order_total_quantity_discounts_basis_ds_manufacturer');
      $this->BASIS_DS_ITEM =  $osC_Language->get('order_total_quantity_discounts_basis_ds_item');
      $this->BASIS_DS_CART =  $osC_Language->get('order_total_quantity_discounts_basis_ds_cart');
      $this->PER_ITEM_OFF =  $osC_Language->get('order_total_quantity_discounts_per_item_off');
      $this->OFF =  $osC_Language->get('order_total_quantity_discounts_off');
      $this->GROSSED_UP =  $osC_Language->get('order_total_quantity_discounts_grossed_up');
      $this->STORE_POLICY =  $osC_Language->get('order_total_quantity_discounts_store_policy'); 

      $this->YOUR_CURRENT_QUANTITY_DISCOUNT =  $osC_Language->get('order_total_quantity_discounts_current_discount'); 
      $this->TOTAL_DISCOUNT =  $osC_Language->get('order_total_quantity_discounts_total_discount'); 
      $this->QD_EXPLANATION = $osC_Language->get('order_total_quantity_discounts_explanation'); 
    }

    // Users seeking more control over output should use get_discount_info()
    function get_html_policy($product) {
        $h_exp = "<br />";
        if ($this->total_level_1 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_1, $this->total_level_1); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_2 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_2, $this->total_level_2); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_3 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_3, $this->total_level_3); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_4 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_4, $this->total_level_4); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_5 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_5, $this->total_level_5); 
           $h_exp .= "<br />"; 
        }

        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $h_exp .= $this->get_level_policy( $this->extra_discounts[$i], $this->extra_levels[$i]);
            $h_exp .= "<br />"; 
        }
  
        $h_exp .= "<br />";
        return $h_exp; 
    }

    function get_level_policy($discount, $level) {
        if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
            $over_level = $level;
        } else {
            $over_level = $this->print_amount($level);  
        }

        if ($this->units == '30') {
            $off_amt = $this->print_amount($discount);
        } else if ($this->units == '32') {
            $off_amt = $this->print_amount($discount);
        } else {
            $off_amt = $discount . "%"; 
        }

        if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
           if ($this->total_basis == '33') {
               $basis = $this->BASIS_CATEGORY;
           } else if ($this->total_basis == 'Total By Manufacturer') {
               $basis = $this->BASIS_MANUFACTURER;
           } else if ($this->total_basis == '34') {
               $basis = $this->BASIS_ITEM;
           } else {
               $basis = $this->BASIS_CART;
           }
        } else {
           if ($this->total_basis == '33') {
               $basis = $this->BASIS_DS_CATEGORY;
           } else if ($this->total_basis == 'Total By Manufacturer') {
               $basis = $this->BASIS_DS_MANUFACTURER;
           } else if ($this->total_basis == '34') {
               $basis = $this->BASIS_DS_ITEM;
           } else {
               $basis = $this->BASIS_DS_CART;
           }
        }

        if ( !isset($this->counting_method) || ($this->counting_method == '36')) { 
           $verb = $this->BUY; 
        } else {
           $verb = $this->SPEND; 
        }
 
        if ($this->units == '32') {
           $h_exp = $verb . " " . $over_level . " " . $basis . " " . $this->GET . " " . $off_amt . " " . $this->PER_ITEM_OFF;
        } else {
           $h_exp = $verb . " " . $over_level . " " . $basis . " " . $this->GET . " " . $off_amt . " " . $this->OFF ;
        }
        return $h_exp; 
    }

    // return info as an array; let people format it as they wish
    // Users seeking a preformatted html string should use get_html_policy()
    function get_discount_info($product) {
        $response_arr = array(); 
        if ($this->total_level_1 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_1, $this->total_level_1); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_2 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_2, $this->total_level_2); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_3 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_3, $this->total_level_3); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_4 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_4, $this->total_level_4); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_5 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_5, $this->total_level_5); 
           $response_arr[] = $h_exp; 
        }

        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $h_exp = $this->get_level_policy( $this->extra_discounts[$i], $this->extra_levels[$i]);
           $response_arr[] = $h_exp; 
        }
        return $response_arr; 
    }


    function get_discount_parms($product, $naked = false) {
        $response_arr = array(); 
        $pos = 0; 

        if ($this->total_level_1 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_1, $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->total_level_1, $naked);
           $pos++; 
        }

        if ($this->total_level_2 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_2, $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->total_level_2, $naked);
           $pos++; 
        }

        if ($this->total_level_3 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_3, $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->total_level_3, $naked);
           $pos++; 
        }

        if ($this->total_level_4 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_4, $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->total_level_4, $naked);
           $pos++; 
        }

        if ($this->total_level_5 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_5, $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->total_level_5, $naked);
           $pos++; 
        }
        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->extra_discounts[$i], $naked);
           $response_arr[$pos]['level'] = $this->format_level($this->extra_levels[$i], $naked);
           $pos++; 
        }
        return $response_arr; 
    }

    // Just in case you only want a number and not a string
    function format_discount($discount, $naked) {
        if ($naked) return $discount;
        if ($this->units == '30') {
            $off_amt = $this->print_amount($discount);
        } else if ($this->units == '32') {
            $off_amt = $this->print_amount($discount);
        } else {
            $off_amt = $discount . "%"; 
        }
        return $off_amt; 
    } 

    function format_level($level, $naked) {
        if ($naked) return $level;
        if ( isset($this->counting_method) && ($this->counting_method == '30')) { 
            $req_level = $this->print_amount($level);
        } else {
            $req_level = $level;
        }
        return $req_level; 
    } 

    function print_amount($amount) {
      global $osC_Currencies;
      return  $osC_Currencies->displayPrice($amount, 0);
    }

    function printit() { 
        echo '<a href="javascript:alert(\'' . $this->explanation . '\');">' . $this->QD_EXPLANATION . '</a>'; 
    }

    function add_extra_level_discount($newlevel, $newdiscount) {
       $this->extra_levels[] = $newlevel;
       $this->extra_discounts[] = $newdiscount;
    }

    function  setup() {
       // Add extra levels and discounts here in this manner: 
       // "Buy more than 100 items, get 50 (% or $, as per admin) off" 
       // $this->add_extra_level_discount(100, 50);
    }

  }
?>
