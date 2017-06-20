<?php namespace Ipunkt\LaravelHealthcheck\Database;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

/**
 * Class TableChecker
 * @package Ipunkt\LaravelHealthcheck\Database
 */
class TableChecker {

	public function check( $database, $table ) {

		try {
			DB::connection($database)->table($table)->take(1)->get();
		} catch(QueryException $e) {
			return false;
		}

		return true;
	}

}