<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit788093c57f45cd4844d68de1212cb7c8
{
    public static $files = array (
        'da253f61703e9c22a5a34f228526f05a' => __DIR__ . '/../..' . '/gump.class.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit788093c57f45cd4844d68de1212cb7c8::$classMap;

        }, null, ClassLoader::class);
    }
}
