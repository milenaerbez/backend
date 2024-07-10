<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakonik extends Model
{
    //use HasFactory;

    protected $table = 'zakonik';
    protected $fillable = ['naziv'];
}