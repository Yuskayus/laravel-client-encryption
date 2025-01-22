<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



 // Untuk menggunakan query builder DB

class ClientCashController extends Controller
{
    public function getClientCash()
    {
        // Query untuk mengambil data
        $result = DB::select(
            "SELECT cc.ClientNID, (cc.Cash - cc.Buy + cc.Sell + cc.MarketValue) AS total_value
            FROM S21Plus_PS.dbo.ClientCash cc
            WHERE cc.ClientNID = ? AND cc.Date = ?",
            [612, '2024-01-01']
        );

        // Mengembalikan data dalam format JSON
        return response()->json($result);
    }
}
