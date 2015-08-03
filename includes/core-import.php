<?php

include 'class-coming-soon-creator.php';
include 'class-admin-options.php';
include 'class-dbmigrations.php';
include 'class-mailchimp.php';

/*
 * 
 * Import template config files
 * 
 */

$template_files = glob(dirname(__FILE__) . '/templates/*.php');

foreach ($template_files as $file) {
    include $file;
}
