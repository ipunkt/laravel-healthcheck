<?php namespace Ipunkt\LaravelHealthcheck\Redis;

use Ipunkt\LaravelHealthcheck\HealthChecker\Checker;
use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckNotFoundException;

/**
 * Class RedisChecker
 * @package Ipunkt\LaravelHealthcheck\Redis
 */
class RedisChecker implements Checker {

	/**
	 * @var array
	 */
	protected $connectionNames = [];

	/**
	 * @var RedisConnnectionChecker
	 */
	private $connectionChecker;

	/**
	 * RedisChecker constructor.
	 * @param RedisConnnectionChecker $connectionChecker
	 */
	public function __construct( RedisConnnectionChecker $connectionChecker) {
		$this->connectionChecker = $connectionChecker;
	}

	/**
	 * @throws HealthcheckNotFoundException
	 */
	public function check() {
		foreach($this->connectionNames as $connectionName) {
			if( ! $this->connectionChecker->check($connectionName) )
				throw new CheckFailedException("Failed to connect to redis connection $connectionName");
		}
	}

	/**
	 * @return array
	 */
	public function getConnectionNames() {
		return $this->connectionNames;
	}

	/**
	 * @param array $connectionNames
	 */
	public function setConnectionNames( array $connectionNames ) {
		$this->connectionNames = $connectionNames;
	}
}