<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SkillSectionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title',
    	'sub_title',
    	'image'
    ];
}
