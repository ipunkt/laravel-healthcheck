<?php namespace Ipunkt\LaravelHealthcheck\Storage;

use Illuminate\Support\ServiceProvider;

/**
 * Class StorageHealthcheckProvider
 * @package Ipunkt\LaravelHealthcheck\Storage
 */
class StorageHealthcheckProvider extends ServiceProvider {

	public function boot() {
		/**
		 * @var HealthcheckerFactory $factory
		 */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$app = $this->app;
		$factory->register('storage', function(array $config) use ($app) {
			/**
			 * @var StorageChecker $storageChecker
			 */
			$storageChecker = $app->make('Ipunkt\LaravelHealthcheck\Storage\StorageChecker');

			$storageChecker->setPathes( $config );

			return $storageChecker;
		});
	}

}