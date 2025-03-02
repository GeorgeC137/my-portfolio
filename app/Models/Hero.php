<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'sub_title',
        'btn_url',
        'btn_text',
        'image',
    ];
}
