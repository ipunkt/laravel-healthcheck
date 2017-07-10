<?php namespace Ipunkt\LaravelHealthcheck\HealthChecker;

/**
 * Interface Checker
 * @package Ipunkt\LaravelHealthcheck\HealthChecker
 */
interface Checker
{
    /**
     * @throws CheckFailedException
     */
    public function check();

}