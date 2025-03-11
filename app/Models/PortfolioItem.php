<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
    	'title',
    	'category_id',
    	'description',
    	'image',
    	'website',
    	'client',
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
