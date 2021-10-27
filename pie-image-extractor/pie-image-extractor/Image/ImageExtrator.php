<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Image;

use PieImageExtractor\Post\Post;
use PieImageExtractor\Image\ImageUploadDir;


/**
 * Main class to extract images from posts
 */
class ImageExtractor
{

    private $upload_basedir;

    private $image_upload_dir_class;

    private $json_response = []; // Success/error messages and resource data (posts, images) 


    public function __construct()
    {
        $this->image_upload_dir_class = new ImageUploadDir();
        $this->upload_basedir = $this->image_upload_dir_class->get_upload_basedir();
    }


    // Return any success/error messages in json
    public function get_json_response() {
        return $this->json_response;
    }
    

    public function run_image_extractor(array $post_ids)
    {

        $post_class = new Post;

        foreach ($post_ids as $post_id) {

            $post = get_post($post_id);

            if ($post) {
                $images = $post_class->get_attached_images_by_parent_post_id($post_id);
                if ($images) {
                   $this->copy_images($post, $images);
                }
            }

        }
    }

	
    private function copy_images(object $post, array $images)
    {

        foreach ($images as $image) {

            if ($image['id']) {


                $source = get_attached_file($image['id']);
                $dest_dir = $this->upload_basedir . $post->post_type;
                $dest = $dest_dir . '/' . $post->post_name . '-' . $image['post_name'] . '.jpg';

                // Get the thumbnail if needed in response
                $thumbnail_url = wp_get_attachment_image_src($image['id'], 'thumbnail');

                $this->image_upload_dir_class->create_folder($dest_dir);

                if (!copy($source, $dest)) {
                    $this->json_response[] = [
                        'status' => 'error',
                        'ok' => false,
                        'text' => 'Image not copied '.$post->post_title,
                        'resource' => [
                            'post' => $post,
                            'image' => $image
                        ]
                    ];
                    
                } else {
                    $this->json_response[] = [
                        'status' => 'success',
                        'ok' => true,
                        'text' => 'Image copied '.$post->post_title,
                        'resource' => [
                            'post' => $post,
                            'image' => $image,
                            'thumbnail' => $thumbnail_url[0]
                        ]
                    ];
                }

            }
        }
    }


}
