<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grad extends Model
{
    //use HasFactory;

    protected $table = 'grad';
    protected $fillable = ['id', 'drzava_id', 'naziv'];
    public function drzava()
    {
        return $this->belongsTo(Drzava::class);
    }

    public function adrese()
    {
        return $this->hasMany(Adresa::class);
    }
}