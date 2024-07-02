<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;


class TokenController extends Controller
{
    // Method untuk mengenkripsi access_token
    public function encryptToken(Request $request)
    {
        // Data yang akan dienkripsi
        $data = [
            'key' => '12345678',
            'timestamp' => Carbon::now()->timestamp
        ];

        // Enkripsi data
        $encrypted = Crypt::encrypt($data);

        return response()->json(['access_token' => $encrypted]);
    }

    // Method untuk mengecek dan mendekripsi access_token
    public function checkToken(Request $request)
    {
        // Mengambil access_token dari query parameter
        $accessToken = $request->query('access_token');

        try {
            // Mendekripsi access_token
            $decrypted = Crypt::decrypt($accessToken);

            // Validasi key
            if ($decrypted['key'] !== '12345678') {
                return response()->json(['message' => 'Invalid key'], 400);
            }

            // Validasi timestamp
            $timestamp = $decrypted['timestamp'];
            $expiredTime = Carbon::createFromTimestamp($timestamp)->addMinutes(1);

            if (Carbon::now()->greaterThan($expiredTime)) {
                return response()->json(['message' => 'Token expired'], 400);
            }

            return response()->json(['message' => 'Token valid'], 200);

        } catch (\Exception $e) {
            Log::error('Token decryption error: ' . $e->getMessage());
            return response()->json(['message' => 'Invalid token'], 400);
        }
    }
}
