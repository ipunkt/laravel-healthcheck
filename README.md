# Laravel Health Check

[![Latest Stable Version](https://poser.pugx.org/ipunkt/laravel-healthcheck/v/stable.svg)](https://packagist.org/packages/ipunkt/laravel-healthcheck) [![Latest Unstable Version](https://poser.pugx.org/ipunkt/laravel-healthcheck/v/unstable.svg)](https://packagist.org/packages/ipunkt/laravel-healthcheck) [![License](https://poser.pugx.org/ipunkt/laravel-healthcheck/license.svg)](https://packagist.org/packages/ipunkt/laravel-healthcheck) [![Total Downloads](https://poser.pugx.org/ipunkt/laravel-healthcheck/downloads.svg)](https://packagist.org/packages/ipunkt/laravel-healthcheck)

configurable healthcheck route for laravel

## Install
	composer require ipunkt/laravel-healthcheck:^1.0.0

Add the `\Ipunkt\LaravelHealthcheck\HealthcheckProvider::class,` to your `providers` section in `config/app.php`.

	php artisan vendor:publish --provider "Ipunkt\LaravelHealthcheck\HealthcheckProvider"

## Usage
Edit the config file `config/healthcheck.php`

see the comments there for more information

### Available checkers
- `database` Tests database connections via Eloquent
- `storage` Tests write access to filesystem paths
- `redis` Tests for accessing redis queue service

## Extend
To add a new Healthchecker implement `Ipunkt\LaravelHealthcheck\HealthChecker\Checker` and register it with the
`Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory`.
The HealtcheckerFactory is registered as singleton so you can use `App::make()` to retrieve it in the `boot` part of a
ServiceProvider and register your Checker.

### HealthcheckerFactory::register
- string $identifier - the identifier which will activate the checker when added to `config('healthcheck.checks')`
- Closure function(array $config) { return new Checker; } - Callback to make the Checker. Receives `$config('healthcheck.$identifier')` as parameter.

### Example
```php
class ServiceProvider {
	public function boot() {

		/**
		 * @var HealthcheckerFactory $factory
		 */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$factory->register('identifier', function(array $config) {

			$newChecker = new ExampleChecker;

			$newChecker->setExampleOption( array_get($config, 'url', 'http://www.example.com') );

			return $newChecker;

		});

	}
}

class ExampleChecker implement Ipunkt\LaravelHealthcheck\HealthChecker\Checker {

	protected $url;

	public function setExampleOption($url) {
		$this->url = $url;
	}

	public function check() {
		$url = $this->url;
		if ( @file_get_contents($url) === false )
			throw new CheckFailedException("Failed to retrieve $url.");
	}
}
```
