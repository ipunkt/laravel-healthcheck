<?php
return [

	/**
	 * Set to false to disable the healthcheck route
	 */
	'enable' => true,

	/**
	 * The GET route where the healthcheck is performed
	 */
	'route' => '/healthcheck',

	/**
	 * Decides which healthchecks are performed
	 *
	 * Available:
	 * - database
	 * - storage
	 * - redis
	 * - solr (needs solarium/solarium package)
	 */
	'checks' => [
		'database',
		'storage',
		'redis',
	],

	/**
	 * Database options:
	 *
	 * 'database connection name' => 'tablename'.
	 * Tested by doing a select limit 1 on
	 */
	'database' => [
		env('DB_CONNECTION', 'mysql') => 'users',
	],

	/**
	 * Storage options:
	 *
	 * '/path/to/check/'
	 * Tested by trying to write the current date to PATH/healthcheck.txt
	 */
	'storage' => [
		storage_path()
	],

	/**
	 * Redis options:
	 *
	 * 'redis connection name'
	 * Redis connection name to test
	 */
	'redis' => [
//        'default',
	],

    /**
     * Solr options
     * Array of instance configuration, each has to configure host, port, path and core
     */
    'solr' => [
        //  solr instance check
        [
            'endpoint' => [
                'default' => [
                    'host' => '',
                    'port' => 9893,
                    'path' => '/solr/',
                    'core' => 'default',
                    'username' => null,
                    'password' => null,
                    'timeout' => 30,
                ],
            ],
        ],
    ],
];
