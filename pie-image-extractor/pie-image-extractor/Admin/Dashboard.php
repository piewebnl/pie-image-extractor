<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Admin;

use PieImageExtractor\Base\Config;


/**
 * Admin Dashboard
 */
class AdminDashboard
{

 
    public function init()
    {
        add_action('admin_menu', [$this, 'create_menu']);
    }


    public function create_menu()
    {

        $user = wp_get_current_user();

        if (in_array('administrator', (array) $user->roles)) {
            add_menu_page(
                'Pie Image Extractor',
                'Pie Image Extractor',
                'administrator',
                __FILE__,
                [$this, 'settings_page'],
                'dashicons-update',
                33);
        }

    }

    public function settings_page()
    {
        ?>
            <div class="wrap">

                <h1><?php _e('Pie Image Extractor', 'pie-image-extractor'); ?></h2>

                <p><small><?php _e('Version: ', 'pie-image-extractor'); ?>: <?php echo Config::get('plugin_version'); ?></small></p>

                <div id="app"></div>

            </div>
        <?php
}

}
