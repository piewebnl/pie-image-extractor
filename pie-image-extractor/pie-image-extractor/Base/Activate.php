<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Base;

use PieImageExtractor\Image\ImageUploadDir;


class Activate
{

    public static function activate()
    {
        
        flush_rewrite_rules();

        $image_upload_dir_class = new ImageUploadDir();

    }

}
