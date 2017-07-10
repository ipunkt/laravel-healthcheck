<?php namespace Ipunkt\LaravelHealthcheck\Solr;

use Illuminate\Support\ServiceProvider;

class SolrHealthcheckProvider extends ServiceProvider {
    public function boot() {
		/** @var HealthcheckerFactory $factory */
		$factory = $this->app->make('Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory');

		$app = $this->app;
		$factory->register('solr', function(array $config) use ($app) {
			/** @var SolrChecker $solrChecker */
			$solrChecker = $app->make('Ipunkt\LaravelHealthcheck\Solr\SolrChecker');
			$solrChecker->configure($config);

			return $solrChecker;
		});
	}
}