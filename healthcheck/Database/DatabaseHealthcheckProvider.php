<?php namespace Ipunkt\LaravelHealthcheck\Database;

use Illuminate\Support\ServiceProvider;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory;

/**
 * Class DatabaseHealthcheckProvider
 * @package Ipunkt\LaravelHealthcheck\Database
 */
class DatabaseHealthcheckProvider extends ServiceProvider {

	public function boot() {
		/**
		 * @var HealthcheckerFactory $factory
		 */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$app = $this->app;
		$factory->register('database', function(array $config) use ($app) {
			/**
			 * @var DatabaseChecker $databaseChecker
			 */
			$databaseChecker = $app->make('Ipunkt\LaravelHealthcheck\Database\DatabaseChecker');

			$databaseChecker->setDatabaseNames( $config );

			return $databaseChecker;
		});
	}
}