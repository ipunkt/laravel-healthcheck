<?php namespace Ipunkt\LaravelHealthcheck;

use Ipunkt\LaravelHealthcheck\HealthChecker\HealthChecker;

/**
 * Class HealthcheckProvider
 */
class HealthcheckProvider extends \Illuminate\Support\ServiceProvider {

	public function register() {

		$factoryClasspath = 'Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory';
		$factory = $this->app->make( $factoryClasspath );
		$this->app->instance($factoryClasspath, $factory);

		$checkerProviders = require_once __DIR__.'/checkers.php';
		foreach($checkerProviders as $checkerProviderClasspath)
			$this->app->register( $checkerProviderClasspath );

	}


	public function boot(  ) {
		$this->publishes([
			__DIR__ . '/config/healthcheck.php' => config_path('healthcheck.php')
		]);

		if( config('healthcheck.enable', true) == false )
			return;

		$this->loadRoutesFrom( __DIR__.'/routes.php' );

		$this->app->bind('Ipunkt\LaravelHealthcheck\HealthChecker\HealthChecker', function($app) {
			$factory = $app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

			return new HealthChecker( $factory, config('healthcheck') );
		});
	}
}