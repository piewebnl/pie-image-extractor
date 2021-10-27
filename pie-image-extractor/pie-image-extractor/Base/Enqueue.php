<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Base;

use PieImageExtractor\Base\Config;

/**
 * Admin (back end) styles and script
 */
class Enqueue
{

   
    public function init()
    {

        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

    }


    // Admin css
    public function enqueue_admin_styles()
    {

        wp_register_style(Config::get('plugin_name'), Config::get('plugin_url') . 'assets/vue/css/'. Config::get('plugin_name').'.css');
        wp_enqueue_style(Config::get('plugin_name'));

      
    }
    

    // Admin js
    public function enqueue_admin_scripts()
    {

        wp_register_script(Config::get('plugin_name') . '-functions', Config::get('plugin_url') . 'assets/vue/js/'. Config::get('plugin_name').'.js', ['jquery'], Config::get('plugin_version'), true);
        wp_enqueue_script(Config::get('plugin_name') . '-functions');

    }

}
