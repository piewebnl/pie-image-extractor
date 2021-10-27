<?php
/**
 * @package pie-image-extractor
 */

use \PieImageExtractor\Base\Config;


$upload_dir = wp_upload_dir();

$pie_image_extractor_config = [
    'plugin_name'     => 'pie-image-extractor',
    'plugin_version'  => PIE_IMAGE_EXTRACTOR_VERSION,
    'plugin_path'     => plugin_dir_path(__FILE__),
    'plugin_url'      => plugin_dir_url(__FILE__),
    'scripts_url'     => plugin_dir_url(__FILE__).'assets/js/', // add trailing slash
    'css_url'         => plugin_dir_url(__FILE__).'assets/css/', // add trailing slash
    'upload_basedir'  => $upload_dir['basedir'] . '/pie-images-extractor/' // add trailing slash (...\wp-content\uploads\pie-images-extractor\)
];

Config::set($pie_image_extractor_config);

