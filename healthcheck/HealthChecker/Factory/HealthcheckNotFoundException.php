<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker\Factory;

/**
 * Class HealthcheckNotFoundException
 * @package Ipunkt\LaravelHealthcheck\HealthChecker\Factory
 */
class HealthcheckNotFoundException extends \RuntimeException {
	/**
	 * @var string
	 */
	private $identifier;

	/**
	 * HealthcheckNotFoundException constructor.
	 * @param string $identifier
	 * @param int $code
	 * @param \Exception|null $e
	 */
	public function __construct($identifier, $code = 0, \Exception $e = null) {
		$this->identifier = $identifier;
		parent::__construct("Healthcheck '$identifier' not found", $code, $e);
	}

}