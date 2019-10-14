<?php

  define('DEBUG', true); // set debug to false for production

  define('DB_NAME', 'cluster_nuevo'); // database name
  define('DB_USER', 'root'); // database user
  define('DB_PASSWORD', '1098643625'); // database password
  define('DB_HOST', 'localhost'); // database host *** use IP address to avoid DNS lookup
/*
  define('DB_NAME', 'fohm2019_cluster_nuevo'); // database name
  define('DB_USER', 'fohm2019_cc'); // database user
  define('DB_PASSWORD', 'cluster_nuevo2019*'); // database password
  define('DB_HOST', 'mysql1006.mochahost.com'); // database host *** use IP address to avoid DNS lookup
*/
  define('DEFAULT_CONTROLLER', 'Home'); // default controller if there isn't one defined in the url
  define('DEFAULT_LAYOUT', 'index'); // if no layout is set in the controller use this layout.

  define('PROOT', '/cluster/'); // set this to '/' for a live server.
  define('VERSION','0.1'); // release version this can be used to display version or version assets like css and js files useful for fighting cached browser files

  define('SITE_TITLE', 'EC2S'); // This will be used if no site title is set
  define('MENU_BRAND', 'EC2S'); //This is the Brand text in the menu

  define('CURRENT_USER_SESSION_NAME', 'clusterec2skwXeusqldkiIKjehsLQZJFKJ'); //session name for logged in user
  define('REMEMBER_ME_COOKIE_NAME', 'clusterec2sJAJEI6382LSJVlkdjfh3801jvD'); // cookie name for logged in user remember me
  define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days)

  define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect
  