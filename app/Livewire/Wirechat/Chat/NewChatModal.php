<?php

namespace App\Livewire\Wirechat\Chat;

use Livewire\Component;
use Namu\WireChat\Models\User as WireChatUser;
use App\Models\User;
use Namu\WireChat\Models\Conversation;
use Namu\WireChat\Models\Participant;

class NewChatModal extends Component
{
    public $search = '';
    public $users = [];
    public $isOpen = false;

    protected $listeners = [
        'openNewChatModal' => 'openModal',
        'closeModal' => 'closeModal'
    ];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', auth()->id())
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                }
            })
            ->get();
    }

    public function createConversation($userId)
    {
        $conversation = Conversation::create();
        
        // Add both users to the conversation
        Participant::create([
            'conversation_id' => $conversation->id,
            'participantable_type' => User::class,
            'participantable_id' => auth()->id(),
        ]);

        Participant::create([
            'conversation_id' => $conversation->id,
            'participantable_type' => User::class,
            'participantable_id' => $userId,
        ]);

        $this->closeModal();
        $this->dispatch('conversationCreated', $conversation->id);
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->loadUsers();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.wirechat.chat.new-chat-modal');
    }
}
