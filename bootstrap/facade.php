<?php

/**
 * facade class
 *
 * 方便一些基础类的使用
 */

/**
 * DB Facade
 *
 * doc: https://cs.laravel-china.org/#db
 */
class DB extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        if (!isset(self::$resolvedInstance['db'])) {
            $dbConfig = [
                'driver' => env('DB_DRIVER'),
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => env('DB_CHARSET'),
                'collation' => env('DB_COLLATION'),
                'prefix' => env('DB_PREFIX'),
            ];
            $capsule = new Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($dbConfig);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $capsule->connection()->enableQueryLog();    // 开启调试
            self::$resolvedInstance['db'] = $capsule;
        }
        return 'db';
    }
}

/**
 * Cache Facade
 *
 * doc: https://github.com/PHPSocialNetwork/phpfastcache
 */
class Cache extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        if (!isset(self::$resolvedInstance['cache'])) {
            $cacheDirver = env('CACHE_DRIVER');
            $defaultDriver = !empty($cacheDirver) ? ucfirst($argv[1]) : 'Files';
            $Psr16Adapter = new phpFastCache\Helper\Psr16Adapter(
                    $defaultDriver,
                    [
                        'securityKey' => md5('cache-token'),
                        'path' => APP_PATH . '/cache/',
                    ]
                );
            self::$resolvedInstance['cache'] = $Psr16Adapter;
        }
        return 'cache';
    }
}
