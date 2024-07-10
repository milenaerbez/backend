<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    // use HasFactory;
    protected $table = 'kandidat';
    protected $fillable = [
        'Ime',
        'Prezime',
        'JMBG',
        'Kontakt',
        'adresa_id',
        'grad_id',
        'drzava_id',
        'kucniBroj',
    ];


    public function grad()
    {
        return $this->belongsTo(Grad::class, 'grad_id');
    }


    public function adresa()
    {
        return $this->belongsTo(Adresa::class, 'adresa_id');
    }

    public function drzava()
    {
        return $this->belongsTo(Drzava::class, 'drzava_id');
    }


}