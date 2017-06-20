<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker;

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
		$config = array_get( $this->config, $name, []);

		$checker = $this->factory->make($name, $config);

		return $checker;
	}

	public function check(  ) {
		$checkerNames = array_get( $this->config, 'checkers', [] );

		foreach($checkerNames as $checkerName) {
			$checker = $this->getChecker($checkerName );

			$checker->check();
		}
	}

}