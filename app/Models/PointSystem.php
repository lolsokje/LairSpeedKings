<?php

namespace App\Models;

use App\Traits\Snowflake;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointSystem extends Model
{
    use HasFactory, Snowflake;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'string',
        'season_id' => 'string',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
