<?php

/**
 * Class StorageCheckerTest
 * @package Storage
 */
class StorageCheckerTest extends TestCase {

	/**
	 * @param string[] $pathes
	 * @dataProvider pathesData
	 * @test
	 */
	public function storage_checker_tests_pathes( $pathes ) {
		$fileContent = 'now now now';

		$fileWriter = Mockery::mock( \Ipunkt\LaravelHealthcheck\Storage\FileWriter::class );
		$dateMaker = Mockery::mock( \Ipunkt\LaravelHealthcheck\Storage\DateMaker::class );
		$dateMaker->shouldReceive('currentDate')->andReturn( $fileContent );

		$storageChecker = new \Ipunkt\LaravelHealthcheck\Storage\StorageChecker($fileWriter, $dateMaker);

		$storageChecker->setPathes( $pathes );
		foreach( $pathes as $path ) {
			$file = $path . '/healthcheck.txt';
			$fileWriter->shouldReceive('write')->with( $file, $fileContent )->once()->andReturn(true);
			$fileWriter->shouldReceive('delete')->with( $file )->once();

		}

		$storageChecker->check();
	}

	public function pathesData() {
		return [
			[ ['randfile', 'storage'] ],
		];
	}
}