<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdf7f518e6f7273f3f3c749a365468f06
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Newsletter\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Newsletter\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitdf7f518e6f7273f3f3c749a365468f06::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdf7f518e6f7273f3f3c749a365468f06::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdf7f518e6f7273f3f3c749a365468f06::$classMap;

        }, null, ClassLoader::class);
    }
}
