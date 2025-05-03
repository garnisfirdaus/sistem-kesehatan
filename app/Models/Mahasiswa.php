<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public function gayaHidup()
    {
        return $this->hasOne(GayaHidup::class);
    }

    public function kesehatan()
    {
        return $this->hasOne(Kesehatan::class);
    }

    public function prediksi()
    {
        return $this->hasOne(Prediksi::class);
    }
}
