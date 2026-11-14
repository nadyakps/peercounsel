<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'counseling_request_id',
        'status',
        'active_mode',
    ];

    public function counselingRequest(): BelongsTo
    {
        return $this->belongsTo(CounselingRequest::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}