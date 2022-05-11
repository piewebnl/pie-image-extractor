<?php
/**
 * @package pie-image-extractor
 */

/*
 * Plugin Name: Pie Image Extractor
 * Description: Copies all original attached post images and stores them in upload folder
 * Version: 0.0.2
 * Author: PieWeb
 */

if (!defined('WPINC')) {
    die;
}

error_reporting(0);

define('PIE_IMAGE_EXTRACTOR_VERSION', '0.0.2');


// Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


// The code that runs during plugin activation
function pie_image_extractor_activate()
{
    PieImageExtractor\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'pie_image_extractor_activate');


// The code that runs during plugin deactivation
function pie_image_extractor_deactivate()
{
    PieImageExtractor\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'pie_image_extractor_deactivate');



// Load config
require_once dirname(__FILE__) . '/config.php';


// Initialize all core classes and pass plugin settings
if (class_exists('PieImageExtractor\\Init')) {

    // Get all classes from composer and init
    $classMap = array_keys(require('vendor/composer/autoload_classmap.php' ));
    PieImageExtractor\Init::run($classMap);
}

