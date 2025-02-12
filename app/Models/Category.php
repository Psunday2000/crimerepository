<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'category_name',
        'slug',
        'category_details',
    ];

    public function crimes(): HasMany{
        return $this->hasMany(Crime::class, 'category_id');
    }
}
