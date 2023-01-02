<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteae6a2a10bce34a5eaac76dbd064ec65
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
            $loader->prefixLengthsPsr4 = ComposerStaticIniteae6a2a10bce34a5eaac76dbd064ec65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteae6a2a10bce34a5eaac76dbd064ec65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteae6a2a10bce34a5eaac76dbd064ec65::$classMap;

        }, null, ClassLoader::class);
    }
}