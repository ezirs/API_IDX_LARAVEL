<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;

class CryptoHelper
{
    // Method untuk mengenkripsi data
    public static function encryptData($data)
    {
        return Crypt::encryptString($data);
    }

    // Method untuk mendekripsi data
    public static function decryptData($encryptedData)
    {
        return Crypt::decryptString($encryptedData);
    }
}
