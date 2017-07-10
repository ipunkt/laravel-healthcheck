<?php namespace Ipunkt\LaravelHealthcheck\Solr;

use Ipunkt\LaravelHealthcheck\HealthChecker\Checker;
use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Solarium\Client;
use Solarium\Exception\ExceptionInterface;

class SolrChecker implements Checker
{
    /**
     * @var array|Client[]
     */
    private $clientInstances = [];

    public function configure(array $config)
    {
        foreach ($config as $instance) {
            if (!empty(array_get($instance, 'host'))) {
                $this->clientInstances[] = new Client($instance);
            }
        }
    }

    /**
     * @throws CheckFailedException
     */
    public function check()
    {
        /** @var Client $clientInstance */
        foreach ($this->clientInstances as $clientInstance) {
            $ping = $clientInstance->createPing();
            try {
                $clientInstance->ping($ping);
            } catch (ExceptionInterface $e) {
                throw new CheckFailedException('Failed to connect to solr server ' . $clientInstance->getOption('host'));
            }
        }
    }
}