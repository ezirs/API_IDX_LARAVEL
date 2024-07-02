<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\CryptoHelper;

class NicknameController extends Controller
{
    public function checkNickname(Request $request)
    {
        // Ambil access token dari query parameter
        $accessToken = $request->query('access_token');

        try {
            // Dekripsi access token menggunakan helper CryptoHelper
            $decryptedToken = CryptoHelper::decryptData($accessToken);

            // Pemisahan waktu dan key dari decrypted token
            $tokenParts = explode(':', $decryptedToken);

            if (count($tokenParts) != 2) {
                throw new \Exception('Invalid token format');
            }

            $time = $tokenParts[0];
            $key = $tokenParts[1];

            // Lakukan validasi waktu di sini jika perlu

            // Lanjutkan logika untuk mengambil data produk atau melakukan operasi lainnya

            // Contoh response
            return response()->json([
                'status' => 'success',
                'message' => 'List of products',
                'time' => $time,
                'key' => $key,
                // Data produk atau response lainnya
            ]);

        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan dalam dekripsi atau validasi
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
