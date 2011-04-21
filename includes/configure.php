<?php
  define('HTTP_SERVER', 'http://shop');
  define('HTTPS_SERVER', 'http://shop');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', 'shop');
  define('HTTPS_COOKIE_DOMAIN', 'shop');
  define('HTTP_COOKIE_PATH', '/');
  define('HTTPS_COOKIE_PATH', '/');
  define('DIR_WS_HTTP_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_WS_IMAGES', 'images/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', 'D:/www/shop/');
  define('DIR_FS_WORK', 'D:/www/shop/includes/work/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');
  define('DIR_FS_BACKUP', 'D:/www/shop/admin/backups/');

  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '1');
  define('DB_DATABASE', 'os3');
  define('DB_DATABASE_CLASS', 'mysqli_innodb');
  define('DB_TABLE_PREFIX', 'osc_');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'database');
?>