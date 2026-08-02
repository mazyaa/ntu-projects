<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'ip_address',
        'read_at',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ContactStatus::class,
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function scopeUnread($query)
    {
        return $query->where('status', ContactStatus::Unread->value);
    }
}
