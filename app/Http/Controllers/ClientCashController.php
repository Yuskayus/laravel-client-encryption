<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;



 // Untuk menggunakan query builder DB

class ClientCashController extends Controller
{
public function getClientCash(Request $request)
{
    // Dapatkan parameter `encryptedId` dari query string
    $encryptedId = $request->query('encryptedId');

    if (!$encryptedId) {
        return response()->json(['error' => 'Parameter encryptedId is required'], 400);
    }

    try {
        // Dekripsi ID
        $decryptedId = Crypt::decrypt($encryptedId);

        // Tanggal tetap
        $fixedDate = '2024-01-01';

        // Query untuk mengambil data
        $result = DB::select(
            "SELECT cc.ClientNID, (cc.Cash - cc.Buy + cc.Sell + cc.MarketValue) AS total_value
            FROM S21Plus_PS.dbo.ClientCash cc
            WHERE cc.ClientNID = ? AND cc.Date = ?",
            [$decryptedId, $fixedDate]
        );

        // Kembalikan hasil dalam JSON
        return response()->json($result);

    } catch (\Exception $e) {
        // Tangani error, misalnya ID tidak valid
        return response()->json(['error' => 'Invalid encryptedId or decryption failed'], 400);
    }
}

}
