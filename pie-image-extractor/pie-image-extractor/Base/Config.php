<?php
/**
 * @package pie-image-extractor
 */

namespace PieImageExtractor\Base;


class Config
{

    static $config = [];

    public static function get(string $key = null): string
    {
        return self::$config[$key];
    }


    public static function set(array $config_array)
    {
        if (is_array($config_array)) {
            foreach ($config_array as $key => $config) {
                self::$config[$key] = $config;
            }
        }
    }
}
