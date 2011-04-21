<?php
require('../../../includes/configure.php');
$CFG = array (
  'charsets' => 'cp1251 utf8 latin1',
  'lang' => 'auto',
  'time_web' => '600',
  'time_cron' => '600',
  'backup_path' => '../../backups/',
  'backup_url' => DIR_WS_HTTPS_CATALOG.'admin/backups/',
  'only_create' => 'MRG_MyISAM MERGE HEAP MEMORY',
  'globstat' => 0,
  'my_host' => DB_SERVER,
  'my_port' => 3306,
  'my_user' => DB_SERVER_USERNAME,
  'my_pass' => DB_SERVER_PASSWORD,
  'my_comp' => 0,
  'my_db' => DB_DATABASE,
  'auth' => 'mysql cfg',
  'user' => DB_SERVER_USERNAME,
  'pass' => '',
  'confirm' => '6',
  'exitURL' => '/admin/',
);
?>