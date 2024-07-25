<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidences';

    protected $fillable =[
        'crime_id',
        'evidence_type',
        'evidence_name',
        'evidence_content',
        'date_collected',
    ];

    public function crime():BelongsTo{
        return $this->belongsTo(Crime::class, 'crime_id');
    }
}
