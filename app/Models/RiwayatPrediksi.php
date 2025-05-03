<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPrediksi extends Model
{
    protected $table = 'riwayat_prediksi';
    
    protected $fillable = [
        'nama',
        'umur',
        'gaya_hidup',
        'riwayat_penyakit',
        'hasil_prediksi',
        'user_id',
    ];

    /**
     * Get the user that owns the prediction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


