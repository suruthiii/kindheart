<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc7ce95bee62a8dcff3004b1310fed988
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc7ce95bee62a8dcff3004b1310fed988::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc7ce95bee62a8dcff3004b1310fed988::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc7ce95bee62a8dcff3004b1310fed988::$classMap;

        }, null, ClassLoader::class);
    }
}
