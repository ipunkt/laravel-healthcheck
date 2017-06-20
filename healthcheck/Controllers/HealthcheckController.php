<?php namespace Ipunkt\LaravelHealthcheck\Controllers;
use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\HealthChecker\HealthChecker;

/**
 * Class HealthcheckController
 * @package Controllers
 */
class HealthcheckController {
	/**
	 * @var HealthChecker
	 */
	private $healthChecker;

	/**
	 * HealthcheckController constructor.
	 * @param HealthChecker $healthChecker
	 */
	public function __construct( HealthChecker $healthChecker) {
		$this->healthChecker = $healthChecker;
	}

	/**
	 *
	 */
	public function healthcheck(  ) {

		try {
			$this->healthChecker->check();
		} catch(CheckFailedException $e) {
			return $this->makeResponse($e->getMessage(), 500);
		}

		return $this->makeResponse('', 200);
	}

	/**
	 * @param $content
	 * @param $code
	 */
	public function makeResponse( $content, $code ) {
		$response = response($content, $code);

		$headers = config('healthcheck.headers');
		foreach($headers as $headerName => $headerValue)
			$response->header($headerName, $headerValue);

		return $response;
	}
}