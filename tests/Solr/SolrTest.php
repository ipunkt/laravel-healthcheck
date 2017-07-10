<?php namespace Solr;

use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\Solr\SolrChecker;

class SolrTest extends \TestCase
{
    /** @test */
    public function it_can_fail_on_missing_solr_connection_ping()
    {
        // ARRANGE
        /** @var SolrChecker $checker */
        $checker = new SolrChecker();
        $checker->configure(array(
            array(
                'host' => 'localhost',
                'port' => 9893,
                'path' => '/solr-does-not-exists/',
                'core' => 'default',
            ),
        ));

        // ACT
        $this->expectException(CheckFailedException::class);

        // ASSERT
        $checker->check();
    }
}