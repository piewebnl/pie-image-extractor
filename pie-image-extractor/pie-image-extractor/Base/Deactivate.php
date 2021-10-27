<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Base;



class Deactivate
{

    public static function deactivate()
    {

        flush_rewrite_rules();

    }

}
