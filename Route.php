<?php
/**
 * Маршрутизатор
 *
 * @author Александр Покацкий
 */
class Route {
    /**
     * Маршруты
     * @var array
     */
    private static $router = [
        ''         => 'TodoList',
        'register' => 'User',
        'login'    => 'User',
        'create'   => 'TodoList',
        'edit'     => 'TodoList'
    ];

    /**
     * Вернуть маршруты
     * @return array
     */
    public static function get() : array
    {
        return self::$router;
    }
    
    private function __construct(){}
    private function __clone() {}
    private function __wakeup() {}
}
