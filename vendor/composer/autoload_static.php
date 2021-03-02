<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf1c334bc41bb987067a67a667a2b7a55
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf1c334bc41bb987067a67a667a2b7a55::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf1c334bc41bb987067a67a667a2b7a55::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf1c334bc41bb987067a67a667a2b7a55::$classMap;

        }, null, ClassLoader::class);
    }
}
