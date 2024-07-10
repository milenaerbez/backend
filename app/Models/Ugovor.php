<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ugovor extends Model
{
    //use HasFactory;

    protected $table = 'ugovor';
    protected $fillable = ['datum', 'sadrzaj', 'kandidat_id'];

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
    public function stavke()
    {
        return $this->hasMany(Stavka_Ugovora::class);
    }

}