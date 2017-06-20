<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker\Factory;

use Closure;

/**
 * Class HealthcheckerFactory
 * @package Ipunkt\LaravelHealthcheck\HealthChecker\Factory
 */
class HealthcheckerFactory {

	/**
	 * @var Closure[]
	 */
	protected $availableCheckers = [
	];

	public function register( $identifier, Closure $builder ) {
		$this->availableCheckers[$identifier] = $builder;
	}

	public function make( $identifier ) {
		if( !array_key_exists($identifier, $this->availableCheckers) )
			throw new HealthcheckNotFoundException($identifier);

		$params = func_get_args();
		array_shift($params);

		return call_user_func_array($this->availableCheckers[$identifier], $params);
	}
}