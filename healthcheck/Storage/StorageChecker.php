<?php namespace Ipunkt\LaravelHealthcheck\Storage;

use Ipunkt\LaravelHealthcheck\HealthChecker\Checker;
use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckNotFoundException;

/**
 * Class StorageChecker
 * @package Ipunkt\LaravelHealthcheck\Storage
 */
class StorageChecker implements Checker {

	/**
	 * @var array
	 */
	protected $pathes = [];
	/**
	 * @var FileWriter
	 */
	private $fileWriter;
	/**
	 * @var DateMaker
	 */
	private $dateMaker;

	/**
	 * StorageChecker constructor.
	 * @param FileWriter $fileWriter
	 */
	public function __construct( FileWriter $fileWriter, DateMaker $dateMaker) {
		$this->fileWriter = $fileWriter;
		$this->dateMaker = $dateMaker;
	}

	/**
	 * @throws HealthcheckNotFoundException
	 */
	public function check() {

		foreach($this->pathes as $path)
			$this->checkPath($path);

	}

	/**
	 * @param string $path
	 */
	protected function checkPath( $path ) {

		$file = $path.'/healthcheck.txt';
		$date = $this->dateMaker->currentDate();

		if( $this->fileWriter->write($file, $date) === false )
			throw new CheckFailedException("Failed to write to $path");

		$this->fileWriter->delete($file);
	}

	/**
	 * @param array $pathes
	 */
	public function setPathes( array $pathes ) {
		$this->pathes = $pathes;
	}
}