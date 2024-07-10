<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stavka_Ugovora extends Model
{
    //use HasFactory;

    protected $table = 'stavka_ugovora';
    protected $fillable = ['id', 'ugovor_id', 'sadrzaj', 'clan_id', 'zakonik_id'];

    public function zakonik()
    {
        return $this->belongsTo(Zakonik::class);
    }

    public function clan()
    {
        return $this->belongsTo(Clan_Zakonika::class);
    }
    public function ugovor()
    {
        return $this->belongsTo(Ugovor::class);
    }
}