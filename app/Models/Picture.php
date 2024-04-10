<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $fillable = ['name', 'path'];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn($path) => Storage::disk('public')->url($path),
            set: fn(UploadedFile $path) => $path->store("/pictures", 'public')
        );
    }
}
