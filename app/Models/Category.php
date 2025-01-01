<?php

namespace App\Models;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'image',];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
