<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Picture extends Model
{
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
