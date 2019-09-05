<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker;

use Illuminate\Support\Arr;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory;

/**
 * Class HealthChecker
 * @package Ipunkt\LaravelHealthcheck\HealthChecker
 */
class HealthChecker {
	/**
	 * @var HealthcheckerFactory
	 */
	private $factory;
	/**
	 * @var array
	 */
	private $config;

	/**
	 * HealthChecker constructor.
	 * @param HealthcheckerFactory $factory
	 * @param array $config
	 */
	public function __construct( HealthcheckerFactory $factory, array $config) {
		$this->factory = $factory;
		$this->config = $config;
	}

	/**
	 * @param string $name
	 * @return Checker
	 */
	protected function getChecker( $name ) {
		$config = Arr::get( $this->config, $name, []);

		$checker = $this->factory->make($name, $config);

		return $checker;
	}

	public function check(  ) {
		$checkerNames = Arr::get( $this->config, 'checks', [] );

		foreach($checkerNames as $checkerName) {
			$checker = $this->getChecker($checkerName );

			$checker->check();
		}
	}

}