<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d01f5c826e8e8a81e6f3f7b8d74656b
{
    public static $files = array (
        'a4ecaeafb8cfb009ad0e052c90355e98' => __DIR__ . '/..' . '/beberlei/assert/lib/Assert/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'Assert\\' => 7,
            'Armetiz\\AirtableSDK\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'Assert\\' => 
        array (
            0 => __DIR__ . '/..' . '/beberlei/assert/lib/Assert',
        ),
        'Armetiz\\AirtableSDK\\' => 
        array (
            0 => __DIR__ . '/..' . '/armetiz/airtable-php/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Buzz' => 
            array (
                0 => __DIR__ . '/..' . '/kriswallsmith/buzz/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d01f5c826e8e8a81e6f3f7b8d74656b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d01f5c826e8e8a81e6f3f7b8d74656b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit1d01f5c826e8e8a81e6f3f7b8d74656b::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}