<?php
/**
 * @package 
 */

namespace PieImageExtractor;

/**
 * Main plugin class
 */
final class Init
{


    // Register and init classes
    public static function run($classMap)
    {
        
        foreach ($classMap as $class)
        {
            if ($class != 'Composer\InstalledVersions' && class_exists($class)) {
                $service = new $class();
                if (method_exists($service, 'init')) {
                    $service->init();
                }
            }
        }

    }
}

