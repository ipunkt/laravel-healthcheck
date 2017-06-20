<?php

use Illuminate\Support\Facades\Route;

Route::get( config('healtcheck.route'), 'Ipunkt\LaravelHealthcheck\Controllers\HealthcheckController@healthcheck' );
