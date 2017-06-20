<?php

/**
 * Class TestCase
 */
class TestCase extends \PHPUnit\Framework\TestCase {

	protected function tearDown() {
		Mockery::close();

		parent::tearDown();
	}


}