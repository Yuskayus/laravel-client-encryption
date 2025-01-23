<?php

namespace App\Http\Controllers;

use App\Models\Client;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;




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

    // public function show($encryptedId)
    // {
    //     // Dekripsi ID dari URL
    //     $decryptedId = Crypt::decrypt($encryptedId);

    //     // Cari data client berdasarkan ID
    //     $client = Client::findOrFail($decryptedId);

    //     return view('clients.show', compact('client'));
    // }

    // public function show($encryptedId)
    // {
    //     try {
    //         // Dekripsi ID dari URL
    //         $decryptedId = Crypt::decrypt($encryptedId);

    //         // Cari data client berdasarkan ID
    //         $client = Client::findOrFail($decryptedId);

    //         // Tanggal tetap
    //         $fixedDate = '2024-01-01';

    //         // Query untuk mengambil nilai total_value dari tabel ClientCash
    //         $clientCash = DB::table('S21Plus_PS.dbo.ClientCash')
    //             ->selectRaw('(Cash - Buy + Sell + MarketValue) AS total_value')
    //             ->where('ClientNID', $decryptedId)
    //             ->where('Date', $fixedDate)
    //             ->first();

    //         // Jika data total_value ditemukan, hitung persentase
    //         if ($clientCash) {
    //             $client->total_value = $clientCash->total_value;

    //             // Tentukan nilai dasar untuk persentase (misalnya nilai maksimum)
    //             $max_value = 10000000000; // Ganti dengan nilai maksimum yang sesuai

    //             // Hitung persentase (dengan membatasi hasil tidak lebih dari 100%)
    //             $client->percentage = min(($client->total_value / $max_value) * 100, 100);
    //         } else {
    //             $client->total_value = null;
    //             $client->percentage = 0; // Set persentase ke 0 jika data tidak ada
    //         }

    //         // Mengirim data ke view
    //         return view('clients.show', compact('client'));

    //     } catch (\Exception $e) {
    //         // Tangani error, misalnya ID tidak valid
    //         return redirect()->back()->withErrors('Invalid encrypted ID or data not found.');
    //     }
    // }

    public function show($encryptedId)
{
    try {
        // Dekripsi ID dari URL
        $decryptedId = Crypt::decrypt($encryptedId);

        // Cari data client berdasarkan ID
        $client = Client::findOrFail($decryptedId);

        // Tanggal tetap
        $fixedDate = '2024-01-01';

        // Mengonversi ActiveDate menjadi objek Carbon (hanya tanggalnya)
        $client->days_registered = Carbon::parse($client->ActiveDate)->startOfDay()->diffInDays(Carbon::now()->startOfDay());

        // Query untuk mengambil nilai total_value dari tabel ClientCash
        $clientCash = DB::table('S21Plus_PS.dbo.ClientCash')
            ->selectRaw('(Cash - Buy + Sell + MarketValue) AS total_value')
            ->where('ClientNID', $decryptedId)
            ->where('Date', $fixedDate)
            ->first();

        // Jika data total_value ditemukan, hitung persentase
        if ($clientCash) {
            $client->total_value = $clientCash->total_value;

            // Tentukan nilai dasar untuk persentase (misalnya nilai maksimum)
            $max_value = 10000000000; // Ganti dengan nilai maksimum yang sesuai

            // Hitung persentase (dengan membatasi hasil tidak lebih dari 100%)
            $client->percentage = min(($client->total_value / $max_value) * 100, 100);
        } else {
            $client->total_value = null;
            $client->percentage = 0; // Set persentase ke 0 jika data tidak ada
        }

        // Query untuk mendapatkan Profit (PL terbesar)
        $profitResult = DB::select("
            SELECT TOP 1
                t.ClientNID,
                t.StockNID,
                SUM((t.TradePrice - ISNULL(cs.avgprice, 0)) * t.TradeVolume) / SUM(ISNULL(cs.avgprice, 0) * t.TradeVolume) AS pl
            FROM S21Plus_PS.dbo.Trade t
            OUTER APPLY (
                SELECT TOP 1 cs.avgprice
                FROM S21Plus_PS.dbo.ClientStock cs
                WHERE cs.clientnid = t.clientnid
                AND cs.stocknid = t.stocknid
                AND cs.Date <= t.TradeDate
                AND cs.avgprice > 0
                ORDER BY cs.date DESC
            ) cs
            WHERE t.TradeDate >= '2024-01-01'
                AND t.TradeDate <= '2024-12-31'
                AND cs.avgprice > 0
                AND t.ClientNID = ?
            GROUP BY t.clientnid, t.stocknid
            ORDER BY t.clientnid, pl DESC
        ", [$decryptedId]);

        // Query untuk mendapatkan Loss (PL terkecil)
        $lossResult = DB::select("
            SELECT TOP 1
                t.ClientNID,
                t.StockNID,
                SUM((t.TradePrice - ISNULL(cs.avgprice, 0)) * t.TradeVolume) / SUM(ISNULL(cs.avgprice, 0) * t.TradeVolume) AS pl
            FROM S21Plus_PS.dbo.Trade t
            OUTER APPLY (
                SELECT TOP 1 cs.avgprice
                FROM S21Plus_PS.dbo.ClientStock cs
                WHERE cs.clientnid = t.clientnid
                AND cs.stocknid = t.stocknid
                AND cs.Date <= t.TradeDate
                AND cs.avgprice > 0
                ORDER BY cs.date DESC
            ) cs
            WHERE t.TradeDate >= '2024-01-01'
                AND t.TradeDate <= '2024-12-31'
                AND cs.avgprice > 0
                AND t.ClientNID = ?
            GROUP BY t.clientnid, t.stocknid
            ORDER BY t.clientnid, pl ASC
        ", [$decryptedId]);

        // Simpan hasil Profit dan Loss ke dalam objek client
        $client->profit = isset($profitResult[0]) ? $profitResult[0]->pl : null;
        $client->loss = isset($lossResult[0]) ? $lossResult[0]->pl : null;

        // Query untuk mendapatkan data StockNID, StockID, StockName, dan Freq
        $stockData = DB::select("
            SELECT TOP 1
                t.StockNID,
                s.StockID,
                s.StockName,
                COUNT(DISTINCT t.TradeDate) AS Freq
            FROM
                S21Plus_PS.dbo.Trade t
            JOIN
                S21Plus_PS.dbo.Stock s
                ON t.StockNID = s.StockNID
            WHERE
                t.TradeDate >= '2024-01-01'
                AND t.TradeDate <= '2024-12-31'
                AND t.ClientNID = ?
            GROUP BY
                t.StockNID,
                s.StockID,
                s.StockName
            ORDER BY
                Freq DESC,
                t.StockNID
        ", [$decryptedId]);

        // Tambahkan hasil query ke dalam objek client
        if (!empty($stockData)) {
            $client->stock_data = $stockData[0]; // Ambil data pertama (karena TOP 1)
        } else {
            $client->stock_data = null;
        }

        // Query untuk mengambil data dinamis berdasarkan ClientNID
        // $clientData = DB::select("
        //     SELECT
        //         c.ClientID,
        //         c.ClientName,
        //         c.CreatedDate AS TanggalPembuatan,
        //         c.ActiveDate AS TanggalAktivasi,
        //         c.LastUpdate AS UpdateDataNasabah,
        //         ct.LastTrxDate AS TransaksiTerakhirNasabah,
        //         CASE
        //             WHEN c.ClientStatus = 1 THEN 'active'
        //             WHEN c.ClientStatus = 2 THEN 'suspended'
        //             WHEN c.ClientStatus = 3 THEN 'closed'
        //             ELSE 'open'
        //         END AS StatusNasabah,
        //         DATEDIFF(DAY, c.ActiveDate, GETDATE()) AS LamaMenjadiNasabahDalamHari,
        //         DATEDIFF(YEAR, c.ActiveDate, GETDATE()) AS LamaMenjadiNasabahDalamTahun
        //     FROM
        //         Client c
        //     LEFT JOIN
        //         ClientTrxLastTrxDateView ct ON ct.ClientNID = c.ClientNID
        //     WHERE
        //         c.ClientNID = :clientNID
        // ", ['clientNID' => $decryptedId]);

        // // Pastikan data ada
        // if (empty($clientData)) {
        //     return redirect()->back()->withErrors('Data tidak ditemukan untuk ID tersebut.');
        // }

        // // Ambil hasil pertama karena query mungkin mengembalikan array
        // $client = $clientData[0];

        // Mengirim data ke view
        return view('clients.show', compact('client'));

    } catch (\Exception $e) {
        // Tangani error jika ID tidak valid
        return redirect()->back()->withErrors('Invalid encrypted ID or data not found.');
    }
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

