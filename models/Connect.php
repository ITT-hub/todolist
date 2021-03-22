<?php

namespace ITTech\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

/**
 * Подключение к базе данных
 *
 * @author Александр Покацкий
 */
class Connect {
    /**
     * Объект подключения к базе данных
     */
    private static $connect = null;

    /**
     * Подключиться к базе данных
     */
    public static function DB() {
        if(is_null(self::$connect))
        {
            // Connect
            $capsule = new Capsule;
            $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"]);
            $dotenv->load();

            $capsule->addConnection([
                'driver'    => $_ENV['driver'],
                'host'      => $_ENV['host'],
                'database'  => $_ENV['database'],
                'username'  => $_ENV['username'],
                'password'  => $_ENV['password'],
                'charset'   => $_ENV['charset'],
                'collation' => $_ENV['collation'],
                'prefix'    => $_ENV['prefix'],
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }
        
        return self::$connect;
    }
    
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}
