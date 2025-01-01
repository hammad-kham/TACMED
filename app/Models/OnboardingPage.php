<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingPage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'order'

    ];
}
