<?php namespace Ipunkt\LaravelHealthcheck\Redis;

use Illuminate\Contracts\Redis\Factory as Redis;

/**
 * Class RedisConnnectionChecker
 * @package Ipunkt\LaravelHealthcheck\Redis
 */
class RedisConnnectionChecker {
	/**
	 * @var Redis
	 */
	private $redis;

	/**
	 * RedisConnnectionChecker constructor.
	 * @param Redis $redis
	 */
	public function __construct( Redis $redis ) {
		$this->redis = $redis;
	}

	/**
	 * @param $connection
	 * @return bool
	 */
	public function check( $connection ) {
		try {
			$connection = $this->redis->connection( $connection );
			$connection->connect();
		} catch(Predis\Network\ConnectionException $exception) {
			return false;
		}

		return true;
	}

}