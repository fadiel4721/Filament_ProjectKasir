<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembelianItem extends Model
{
    use HasFactory;


    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }
}
