<?php

/*
  Plugin Name: IgniteUp
  Plugin URI: http://plugins.ceylonsystems.com
  Description: IgniteUp is a powerful plugin which allows you to keep your site on launchpad till ignite-up and to build amazing coming soon pages.
  Version: 1.0.3
  Author: Ceylon Systems
  Author URI: http://ceylonsystems.com
  License: GPLv2 or later
  Text Domain: _cscs_igniteup
  Domain Path: ./languages/
 */
 
require_once 'includes/core-import.php';

new CSComingSoonCreator(__FILE__);