<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Api;

use PieImageExtractor\Post\Post;


/**
 * The api/route to return all posts with attached images
 */
class ApiPostWithImage
{
    
    public function init()
    {
        add_action('rest_api_init', [$this, 'rest_api_init_post_with_images']);
    }

    
    // Rest Route: /wp-json/image-extractor/v1/posts-with-images
    public function rest_api_init_post_with_images()
    {
        register_rest_route('image-extractor/v1', '/posts-with-images', [
            'methods' => 'GET',
            'callback' => [$this, 'get_posts_with_images']
        ]);

    }
    

    // Find and return all post ids with images attachted to them
    public function get_posts_with_images(): object
    {

		$post_class = new Post;
		$posts = $post_class->get_posts_with_images();

		$response = new \WP_REST_Response($posts);
		$response->set_status(200);

		return $response;

    }

}