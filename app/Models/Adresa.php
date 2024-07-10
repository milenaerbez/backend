<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresa extends Model
{
    use HasFactory;

    protected $table = 'adresa';
    protected $fillable = ['id', 'grad_id', 'drzava_id', 'ulica'];
    public function grad()
    {
        return $this->belongsTo(Grad::class);
    }


}