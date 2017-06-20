<?php
return [
	'route' => '/healthcheck',

	/**
	 * Decides which healthchecks are performed
	 *
	 * Available:
	 * - database
	 * - storage
	 */
	'checks' => [
		'database',
		'storage'
	],

	'database' => [
		'dbname' => 'dbtable',
	],

	'storage' => [
		storage_path()
	],
];
