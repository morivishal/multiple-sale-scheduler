<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f39a0d0c6791b8e723b76882c88d178
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Multiplesalescheduler\\Mss\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Multiplesalescheduler\\Mss\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f39a0d0c6791b8e723b76882c88d178::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f39a0d0c6791b8e723b76882c88d178::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6f39a0d0c6791b8e723b76882c88d178::$classMap;

        }, null, ClassLoader::class);
    }
}
