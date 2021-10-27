<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Image;


use PieImageExtractor\Base\Config;


/**
 * Create/set the needed upload folders
 * \wp-content\uploads\pie-images-extractor\
 * \wp-content\uploads\pie-images-extractor\{post-type}\
 */
class ImageUploadDir
{

    private $upload_basedir;


    public function __construct()
    {
        $this->upload_basedir = Config::get('upload_basedir');
        $this->create_folder( $this->upload_basedir);
    }

    
	public function get_upload_basedir() {
		return $this->upload_basedir;
	}

	
    public function create_folder($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
    }
}