<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselingRequest extends Model
{
    protected $fillable = [
        'konseli_id',
        'konselor_id',
        'topic',
        'description',
        'status',
    ];

    public function konseli()
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }

    public function konselor()
    {
        return $this->belongsTo(User::class, 'konselor_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
}