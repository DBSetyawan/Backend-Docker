<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('API ACI Fullstack developer depends on Docker In system administration, orchestration is the automated configuration, coordination, and management of computer systems and software.');
});

Route::get('/test-json', function () {
    return response()->json(['sdasd' => User::all()]);
});
