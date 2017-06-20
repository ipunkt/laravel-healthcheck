<?php namespace Factory;

use Ipunkt\LaravelHealthcheck\HealthChecker\Factory\HealthcheckerFactory;
use TestCase;

/**
 * Class FactoryTest
 * @package Factory
 */
class FactoryTest extends TestCase {

	/**
	 * @test
	 * @dataProvider parameters
	 * @param $expectedReturn
	 * @param $expectedFirst
	 * @param $expectedSecond
	 */
	public function check_factory( $expectedReturn, $expectedFirst, $expectedSecond ) {
		$factory = new HealthcheckerFactory();

		$p1 = '';
		$p2 = '';


		$factory->register('test', function($return, $parameter1, $parameter2) use (&$p1, &$p2) {
				$p1 = $parameter1;
				$p2 = $parameter2;
				return $return;
			});

		$return = $factory->make('test', $expectedReturn, $expectedFirst, $expectedSecond);

		$this->assertEquals($expectedReturn, $return);
		$this->assertEquals($expectedFirst, $p1);
		$this->assertEquals($expectedSecond, $p2);
	}

	public function parameters(  ) {
		return [
			['Healthcheck', 't1', 't2'],
			['Health', 'cookies', 'ohai'],
		];

	}
}
