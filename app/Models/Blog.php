<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    	'title',
    	'category',
    	'description',
    	'image',
    ];

    public function getCategory()
    {
    	return $this->belongsTo(BlogCategory::class, 'category', 'id');
    }
}
