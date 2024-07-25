<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'crime_id',
        'case_number',
        'case_title',
        'date_created'
    ];

    public function crime(): BelongsTo
    {
        return $this->belongsTo(Crime::class, 'crime_id');
    }
}
