<?php
namespace WPEloquent;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
	protected static $capsule;

	public static function connect($options = [])
	{
		$defaults = [
		  'driver'    => 'mysql',
		  'prefix'    => 'wp_',
			'host'      => '',
			'database'  => '',
			'username'  => '',
			'password'  => '',
			'port'      => '3306',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
		];

		if (is_null(self::$capsule)) {

				self::$capsule = new Capsule();
								
				self::$capsule->addConnection(array_merge($defaults, $options));
				self::$capsule->bootEloquent();
		}
		return self::$capsule;
	}

	public static function getConnection()
	{
		return self::$capsule->getConnection();
	}
}