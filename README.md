# laravel-healthcheck
configurable healthcheck route for laravel

## Usage
To use the default options simply do:

	php artisan vendor:publish
	
## Customize
Edit the config file `config/healthcheck.php`

Add more checkers to `healtcheck.checkers`. Available checkers are:
- `database`
- `storage`

Add options to `healthcheck.CHECKERNAME => [ 'option' => 'value' ]`

## Checkers

### Database
Attempts to open a database connection to the default database.

### Storage
Attempts to write a file to 
	
## Extend
To add a new Healthchecker implement `Ipunkt\LaravelHealthcheck\HealthChecker\Checker` and register it with the
`Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory`.
The HealtcheckerFactory is registered as singleton so you can use `App::make()` to retrieve it in the `boot` part of a
ServiceProvider and register your Checker.

### HealthcheckerFactory::register
- string $identifier - the identifier which will activate the checker when added to `config('healthcheck.checks')`
- Closure function(array $config) { return new Checker; } - Callback to make the Checker. Receives `$config('healthcheck.$identifier'')` as parameter.

### Example
```php
class ServiceProvider {
	public function boot() {
	
		/**
		 * @var HealthcheckerFactory $factory
		 */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$factory->register('identifier', function(array $config) {
		
			$newChecker = new Checker;
			
			$newChecker->setExampleOption( array_get($config, 'url', 'http://www.example.com') );
		
			return ExampleChecker;
			
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
