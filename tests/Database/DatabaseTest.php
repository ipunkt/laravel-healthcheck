<?php

/**
 * Class DatabaseTest
 * @package Database
 */
class DatabaseTest extends TestCase {

	/**
	 * @param array $databases
	 * @dataProvider dbData
	 */
	public function test_database_checker( $databases, $succeed ) {

		$checker = Mockery::mock(\Ipunkt\LaravelHealthcheck\Database\TableChecker::class);

		$dbChecker = new \Ipunkt\LaravelHealthcheck\Database\DatabaseChecker($checker);
		$dbChecker->setDatabaseNames( $databases );

		foreach( $databases as $database => $table  )
			$checker->shouldReceive('check')->with($database, $table)->once()->andReturn($succeed);

		if(!$succeed)
			$this->expectException(\Ipunkt\LaravelHealthcheck\HealthChecker\CheckFailedException::class);

		$dbChecker->check();

	}

	public function dbData(  ) {
		return [
			[ ['news' => 'test'], true, ],
			[ ['news' => 'test'], false, ],
		];
	}
}