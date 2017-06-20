<?php

use Illuminate\Support\Facades\Route;

Route::get( config('healthcheck.route'), 'Ipunkt\LaravelHealthcheck\Controllers\HealthcheckController@healthcheck' );
