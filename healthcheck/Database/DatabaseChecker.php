<?php namespace Ipunkt\LaravelHealthcheck\Database;

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
	 * @var TableChecker
	 */
	private $tableChecker;

	/**
	 * DatabaseChecker constructor.
	 * @param TableChecker $tableChecker
	 */
	public function __construct( TableChecker $tableChecker) {
		$this->tableChecker = $tableChecker;
	}

	/**
	 * @throws HealthcheckNotFoundException
	 */
	public function check() {
		foreach($this->databaseNames as $databaseName => $databaseTable) {

			if( !$this->tableChecker->check($databaseName, $databaseTable))
				throw new CheckFailedException("Failed to connect to database $databaseName");
		}
	}

	/**
	 * @param array $databaseNames
	 */
	public function setDatabaseNames( array $databaseNames ) {
		$this->databaseNames = $databaseNames;
	}
}