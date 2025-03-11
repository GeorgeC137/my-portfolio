<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioSettingSection extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'sub_title',
    	'id'
    ];
}
