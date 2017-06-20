<?php namespace Ipunkt\LaravelHealthcheck\Database;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Ipunkt\LaravelHealthcheck\HealthChecker\Checker;
use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckNotFoundException;

/**
 * Class DatabaseChecker
 * @package Ipunkt\LaravelHealthcheck\Database
 */
class DatabaseChecker implements Checker {

	/**
	 * @var array
	 */
	protected  $databaseNames = [];

	/**
	 * @throws HealthcheckNotFoundException
	 */
	public function check() {
		foreach($this->databaseNames as $databaseName => $databaseTable) {

			try {
				DB::connection($databaseName)->table($databaseTable)->take(1)->get();
			} catch(QueryException $e) {
				throw new CheckFailedException("Failed to connect to database $databaseName");
			}
		}
	}

	/**
	 * @param array $databaseNames
	 */
	public function setDatabaseNames( array $databaseNames ) {
		$this->databaseNames = $databaseNames;
	}
}