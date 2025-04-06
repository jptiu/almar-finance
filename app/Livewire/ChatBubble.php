<?php

namespace App\Livewire;

use Livewire\Component;
use Namu\WireChat\Models\Participant;
use App\Models\User;

class ChatBubble extends Component
{
    public $isOpen = false;
    public $unreadCount = 0;
    protected $listeners = [
        'messageReceived' => 'handleNewMessage',
        'messageSent' => 'handleNewMessage'
    ];
    
    public function mount()
    {
        // Get unread messages by checking conversations through participants
        $this->unreadCount = Participant::where('participantable_type', User::class)
            ->where('participantable_id', auth()->id())
            ->whereNull('conversation_read_at')
            ->count();
    }
    
    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->unreadCount = 0;
            // Mark conversations as read
            Participant::where('participantable_type', User::class)
                ->where('participantable_id', auth()->id())
                ->whereNull('conversation_read_at')
                ->update(['conversation_read_at' => now()]);
        }
    }
    
    public function handleNewMessage()
    {
        if (!$this->isOpen) {
            $this->unreadCount++;
        }
    }

    public function render()
    {
        return view('livewire.chat-bubble');
    }
}