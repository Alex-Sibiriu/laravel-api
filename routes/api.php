<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/projects/technologies', [ProjectController::class, 'technologies']);

Route::get('/projects/types', [ProjectController::class, 'types']);

Route::get('/projects/search/{title?}/{type?}', [ProjectController::class, 'searchProjects']);
