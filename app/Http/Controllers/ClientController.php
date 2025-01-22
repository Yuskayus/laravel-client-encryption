<?php

namespace App\Http\Controllers;

use App\Models\Client;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
// use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;


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
}

