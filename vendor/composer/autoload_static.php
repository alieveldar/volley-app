<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9646c46d0bc5d51c85e3825a9a2c68f
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VK\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VK\\' => 
        array (
            0 => __DIR__ . '/..' . '/vkcom/vk-php-sdk/src/VK',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9646c46d0bc5d51c85e3825a9a2c68f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9646c46d0bc5d51c85e3825a9a2c68f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
