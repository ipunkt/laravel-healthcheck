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

    /**
     * configure solr checker
     *
     * @param array $config
     * @throws \Solarium\Exception\InvalidArgumentException
     */
    public function configure(array $config)
    {
        foreach ($config as $instance) {
            try {
                $this->clientInstances[] = new Client($instance);
            } catch (\Exception $e) {
                throw new InvalidArgumentException('Client is not working', 0, $e);
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