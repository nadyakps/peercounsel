<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'availability_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi pengajuan konseling sebagai konseli
    public function counselingRequestsAsKonseli(): HasMany
    {
        return $this->hasMany(CounselingRequest::class, 'konseli_id');
    }

    // Relasi pengajuan konseling sebagai konselor
    public function counselingRequestsAsKonselor(): HasMany
    {
        return $this->hasMany(CounselingRequest::class, 'konselor_id');
    }

    // Relasi pesan yang dikirim pengguna
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}