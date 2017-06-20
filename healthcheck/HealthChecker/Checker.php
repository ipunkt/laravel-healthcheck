<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker;

use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckNotFoundException;

/**
 * Interface Checker
 * @package Ipunkt\LaravelHealthcheck\HealthChecker
 */
interface Checker {

	/**
	 * @throws HealthcheckNotFoundException
	 */
	function check();

}