<?php namespace Redis;

use Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException;
use Ipunkt\LaravelHealthcheck\Redis\RedisChecker;
use Ipunkt\LaravelHealthcheck\Redis\RedisConnnectionChecker;
use Mockery;

/**
 * Class RedisTest
 * @package Redis
 */
class RedisTest extends \TestCase {

	/**
	 * @test
	 * @dataProvider dataProvider
	 */
	public function redis_checker( $connections, $succeeds ) {

		$connectionChecker = Mockery::mock(RedisConnnectionChecker::class);

		$checker = new RedisChecker( $connectionChecker );
		$checker->setConnectionNames($connections);

		if( !$succeeds )
			$this->expectException( CheckFailedException::class );

		foreach( $connections as $connection )
			$connectionChecker->shouldReceive('check')->with($connection)->once()->andReturn( $succeeds );

		$checker->check();
	}

	public function dataProvider(  ) {
		return [
			[ [ 'test' ], true ],
			[ [ 'cookies' ], false ],
		];
	}
}