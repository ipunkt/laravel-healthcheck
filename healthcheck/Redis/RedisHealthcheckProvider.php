<?php namespace Ipunkt\LaravelHealthcheck\Redis;

use Illuminate\Support\ServiceProvider;
use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory;

/**
 * Class RedisHealthcheckProvider
 * @package Ipunkt\LaravelHealthcheck\Redis
 */
class RedisHealthcheckProvider extends ServiceProvider {

	public function boot() {
		/**
		 * @var HealthcheckerFactory $factory
		 */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$app = $this->app;
		$factory->register('redis', function(array $config) use ($app) {
			/**
			 * @var RedisChecker $redisChecker
			 */
			$redisChecker = $app->make('Ipunkt\LaravelHealthcheck\Redis\RedisChecker');

			$redisChecker->setConnectionNames( $config );

			return $redisChecker;
		});
	}

}