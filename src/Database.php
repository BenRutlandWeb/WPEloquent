<?php

namespace WPEloquent;

use Illuminate\Database\Capsule\Manager;

class Database
{
    /**
     * The Manager instance.
     *
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected static $instance;

    /**
     * Connect to the database.
     *
     * @param array $options
     * @return \Illuminate\Database\Capsule\Manager
     */
    public static function connect(array $options = []): Manager
    {
        global $wpdb;

        $defaults = [
            'driver'    => 'mysql',
            'prefix'    => $wpdb->prefix,
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'port'      => '3306',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ];

        $instance = self::getInstance();
        $instance->addConnection(array_merge($defaults, $options));
        $instance->bootEloquent();

        return $instance;
    }

    /**
     * Return the instance of the Manager.
     *
     * @return \Illuminate\Database\Capsule\Manager
     */
    public static function getInstance(): Manager
    {
        if (!self::$instance) {
            self::$instance = new Manager();
        }
        return self::$instance;
    }
}
