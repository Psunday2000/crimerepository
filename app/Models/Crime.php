<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Crime extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'crime_title',
        'crime_description',
        'date_created',
        'officer_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function evidences(): HasMany
    {
        return $this->hasMany(Evidence::class, 'crime_id');
    }

    public function officer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function suspects(): HasMany
    {
        return $this->hasMany(Suspect::class, 'crime_id');
    }

    public function casefile(): HasOne
    {
        return $this->hasOne(CaseFile::class, 'crime_id');
    }
}
