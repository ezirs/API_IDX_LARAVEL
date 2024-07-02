<?php

use App\Helpers\CryptoHelper;
use App\Http\Controllers\API\NicknameController;
use App\Http\Controllers\API\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(NicknameController::class)->group(function() {
    Route::get('/check-nickname', 'checkNickname')->name('checkNickname');
});

Route::get('encrypt-token', [TokenController::class, 'encryptToken']);
Route::get('check-nickname', [TokenController::class, 'checkToken']);