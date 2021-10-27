<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Image;



class Image
{

    // Get image url from a post
    public function get_image_url(string $post_id):array
    {
		global $wpdb, $table_prefix;

        $query = $wpdb->prepare("
                    SELECT
                        *
                              FROM
                        " . $table_prefix . "postmeta
                    WHERE
					   meta_key = '_wp_attached_file' AND
                       post_id = %s
                    ", $post_id);

        $wpdb->query($query);

        $result = $wpdb->get_row($query);

        if ($result->meta_value) {
            return $result->meta_value;
        }

    }
}
