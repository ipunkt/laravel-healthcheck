<?php namespace Ipunkt\LaravelHealthcheck\Storage;

/**
 * Class DateMaker
 * @package Ipunkt\LaravelHealthcheck\Storage
 */
class DateMaker {

	/**
	 * @return string
	 */
	public function currentDate(  ) {

		return date('Y-m-d H:i:s');

	}

}