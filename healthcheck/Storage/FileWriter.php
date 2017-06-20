<?php namespace Ipunkt\LaravelHealthcheck\Storage;

/**
 * Class FileWriter
 * @package Ipunkt\LaravelHealthcheck\Storage
 */
class FileWriter {

	/**
	 * @param $path
	 * @param $content
	 * @return bool
	 */
	public function write( $path, $content ) {
		return @file_put_contents($path, $content) !== false;
	}

	public function delete( $path ) {
		return @unlink($path);
	}

}