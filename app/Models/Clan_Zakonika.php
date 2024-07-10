<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan_Zakonika extends Model
{
    //use HasFactory;
    protected $table = 'clan_zakonika';
    protected $fillable = ['id', 'zakonik_id', 'brojClana', 'sadrzaj'];
}