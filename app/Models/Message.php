<?php

namespace App\Models;

use Namu\WireChat\Models\Message as BaseMessage;

class Message extends BaseMessage
{
    protected $table = 'wire_messages';

    protected $fillable = [
        'body',
        'sendable_id',
        'sendable_type',
        'file_path',
        'file_name'
    ];

    protected $casts = [
        'file_path' => 'string',
        'file_name' => 'string'
    ];

    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    public function scopeForUser($query, $userId)
    {
        return $query->whereHas('conversation.participants', function ($query) use ($userId) {
            $query->where('participantable_id', $userId)
                ->where('participantable_type', User::class)
                ->whereNull('exited_at')
                ->where(function ($query) {
                    $query->whereNull('conversation_cleared_at')
                        ->orWhere('created_at', '>', 'conversation_cleared_at');
                });
        });
    }

    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at')
            ->whereDoesntHave('actions', function ($query) {
                $query->where('type', 'delete');
            });
    }
}
