<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Post;

class Post
{

	// Get all post_ids with images attached to them
    public function get_posts_with_images(): array
    {

        global $wpdb, $table_prefix;

        $query = "
			SELECT
				post_parent
			FROM
				" . $table_prefix . "posts
			WHERE
				post_type = 'attachment' AND
				post_mime_type = 'image/jpeg' AND
				post_parent > 0
			GROUP BY
				post_parent
			";
        $results = $wpdb->get_results($query, ARRAY_N);

        $ids = [];
        if ($results) {
            foreach ($results as $result) {
                $ids[] = (int) $result[0];
            }
        }

        return $ids;
    }


	// Get all images by post id
    public function get_attached_images_by_parent_post_id(int $parent_post_id): array
    {

        global $wpdb, $table_prefix;

        $query = $wpdb->prepare("
			SELECT
				id, post_title, post_name
			FROM
				" . $table_prefix . "posts
			WHERE
				post_type = 'attachment' AND
				post_mime_type = 'image/jpeg' AND
				post_parent = %s

			", $parent_post_id);

        return $wpdb->get_results($query, ARRAY_A);

    }

}
