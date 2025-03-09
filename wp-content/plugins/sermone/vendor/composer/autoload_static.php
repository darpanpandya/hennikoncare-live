<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ebdff0a7075b1ff93cd8dc4a119fec3
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2ebdff0a7075b1ff93cd8dc4a119fec3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2ebdff0a7075b1ff93cd8dc4a119fec3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
