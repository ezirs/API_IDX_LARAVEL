<?php

use App\Helpers\CryptoHelper;
use App\Http\Controllers\API\NicknameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    // Contoh pembuatan token enkripsi
    $time = time(); // Waktu saat ini (timestamp)
    $key = '12345678'; // Ganti dengan kunci rahasia Anda

    // Gabungkan waktu dan key, kemudian enkripsikan menggunakan CryptoHelper
    $token = CryptoHelper::encryptData("$time:$key");

    // Hasilnya adalah token yang siap digunakan
    echo $token; // Misalnya hasilnya adalah sesuatu seperti "eyJpdiI6ImUwUmt..."

    // Untuk mengakses URL API dengan token yang sudah dienkripsi, hasilkan URL sebagai berikut:
    $apiUrl = "https://example.com/api/list-product?access_token=" . urlencode($token);
    echo $apiUrl; // Hasilnya adalah URL yang bisa digunakan dalam aplikasi Anda
});

Route::controller(NicknameController::class)->group(function() {
    Route::get('/check-nickname', 'checkNickname')->name('checkNickname');
});