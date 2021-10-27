<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Api;


use PieImageExtractor\Image\ImageExtractor;

/**
 * The main api/route to extract images from posts
 */
class ApiImageExtractor
{

    public function init()
    {
        add_action('rest_api_init', [$this, 'rest_api_init_extract_images']);
    }


    // Rest Route: /wp-json/image-extractor/v1/extract-images
    public function rest_api_init_extract_images()
    {
        register_rest_route('image-extractor/v1', '/extract-images', [
            'methods' => 'POST',
            'callback' => [$this, 'post_extract_images'],
        ]);

    }


    // Extract all attached images per post id
    public function post_extract_images(object $data): object
    {

        $ids = $data->get_param('ids');

        if (!$ids) {
            $response = new \WP_REST_Response();
            $response->set_status(204);
            return $response;
        }

        // the main extractor
        $image_extractor_class = new ImageExtractor;
        $image_extractor_class->run_image_extractor($ids);
        $json_response = $image_extractor_class->get_json_response();

        $response = new \WP_REST_Response($json_response);
        $response->set_status(200);

        return $response;

    }

}
