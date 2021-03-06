<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc75f7a3814bd1c23c950e1bf43c0c3b7
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitc75f7a3814bd1c23c950e1bf43c0c3b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc75f7a3814bd1c23c950e1bf43c0c3b7::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc75f7a3814bd1c23c950e1bf43c0c3b7::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
