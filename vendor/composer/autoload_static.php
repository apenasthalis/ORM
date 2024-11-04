<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb08d40d8d78131a3afad6250e90bb40c
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Ipeweb\\Crud\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ipeweb\\Crud\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb08d40d8d78131a3afad6250e90bb40c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb08d40d8d78131a3afad6250e90bb40c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb08d40d8d78131a3afad6250e90bb40c::$classMap;

        }, null, ClassLoader::class);
    }
}