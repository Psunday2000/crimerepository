<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suspect extends Model
{
    use HasFactory;

    protected $fillable =[
        'crime_id',
        'suspect_name',
        'mugshot',
        'height',
        'address',
        'date_of_birth',
        'date_created'
    ];

    public function crime():BelongsTo{
        return $this->belongsTo(Crime::class, 'crime_id');
    }
}
