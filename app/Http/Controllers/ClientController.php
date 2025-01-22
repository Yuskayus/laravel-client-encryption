<?php

namespace App\Http\Controllers;

use App\Models\Client;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;




class ClientController extends Controller
{
    public function index()
    {
        Log::info('Memulai query untuk mengambil data klien.');

        // Ambil data dari database
        $clients = DB::table('client')->get();

        Log::info('Query selesai. Jumlah data: ' . $clients->count());


        return view('clients.index', compact('clients'));
    }

    public function show($encryptedId)
    {
        // Dekripsi ID dari URL
        $decryptedId = Crypt::decrypt($encryptedId);

        // Cari data client berdasarkan ID
        $client = Client::findOrFail($decryptedId);

        return view('clients.show', compact('client'));
    }

    public function showDetails($encryptedId)
    {
        try {
            // Mendekripsi clientid
            $decryptedId = Crypt::decryptString($encryptedId);

            // Tanggal mulai dan selesai (gunakan sesuai dengan kebutuhan Anda)
            $startDate = '2024-01-01';
            $endDate = '2024-12-31';

            // Jalankan query dengan clientid yang sudah didekripsi
            $results = DB::select("
                SELECT TOP 1 t.ClientNID, t.StockNID,
                    SUM((t.TradePrice - ISNULL(cs.avgprice, 0)) * t.TradeVolume) /
                    SUM(ISNULL(cs.avgprice, 0) * t.TradeVolume) AS pl
                FROM S21Plus_PS.dbo.Trade t
                OUTER APPLY (
                    SELECT TOP 1 cs.avgprice
                    FROM S21Plus_PS.dbo.ClientStock cs
                    WHERE cs.ClientNID = t.ClientNID
                    AND cs.stocknid = t.stocknid
                    AND cs.Date <= t.TradeDate
                    AND cs.avgprice > 0
                    ORDER BY cs.date DESC
                ) cs
                LEFT JOIN S21Plus_PS.dbo.client c ON t.ClientNID = c.ClientNID
                WHERE t.TradeDate >= ?
                AND t.TradeDate <= ?
                AND cs.avgprice > 0
                AND t.ClientNID = (
                    SELECT ClientNID
                    FROM S21Plus_PS.dbo.client
                    WHERE clientid = ?
                    LIMIT 1
                )
                GROUP BY t.ClientNID, t.stocknid
                ORDER BY t.ClientNID, pl DESC
            ", [$startDate, $endDate, $decryptedId]);  // Gantilah $decryptedId dengan clientid yang sudah didekripsi

            // Kembalikan hasil ke view
            return view('client.details', ['results' => $results]);

        } catch (\Exception $e) {
            // Tangani error jika dekripsi gagal
            return response()->json(['error' => 'Invalid client ID or decryption error'], 400);
        }
    }


}

