<?php

use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function() {
    return [
        [
            'id'    => 1,
            'name'  => 'Tigr'
        ],
        [
            'id'    => 2,
            'name'  => 'Test'
        ],
        [
            'id'    => 3,
            'name'  => 'Durak',
        ]
    ];
});

Route::prefix('/register')->group(function() {
    Route::post('/', function(Request $request) {
        $login =  $request->email;
        $password = $request->password;

        return [
            'data'  => compact('login', 'password')
        ];
    });

    Route::post('/', [RegisterController::class, 'register']);

    Route::post('/confirm/retry', [RegisterController::class, 'retryConfirm']);
    Route::post('/confirm', [RegisterController::class, 'confirm']);
});



Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::post('/token/create', function(Request $request) {
    $user = \App\Models\User::factory()->create([
       'name'   => 'tigr',
        'email' => 'tigr@mail.com',
    ]);

    $token = $user->createToken('app:user');

    return ['token' => $token->plainTextToken];
});

Route::post('/message', [ChatController::class, 'index']);
