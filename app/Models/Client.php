<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client'; // Ganti dengan nama tabel di SQL Server
    protected $primaryKey = 'ClientNID'; // Ganti dengan primary key tabel
    public $timestamps = false; // Nonaktifkan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
}

