<?php
class Autoloader
{
    public static function register(string $baseDir): void
    {
        spl_autoload_register(function ($class) use ($baseDir) {
            $directories = [
                'controllers',
                'models',
                'core',
                'helpers',
                'middlewares',
                'services'
            ];
            foreach ($directories as $dir) {
                $file = $baseDir . '/' . $dir . '/' . $class . '.php';
                if (file_exists($file)) {
                    require $file;
                    return;
                }
            }
        });
    }
}
