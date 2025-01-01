<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;
    
    protected $fillable = ['category_id', 'title', 'description', 'image',];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
