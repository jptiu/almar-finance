<?php

namespace App\Livewire\Wirechat\Chat;

use Livewire\Component;
use Livewire\WithFileUploads;
use Namu\WireChat\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class ChatView extends Component
{
    use WithFileUploads;

    public $conversation = null;
    public $messages = [];
    public $message = '';
    public $file = null;

    protected $listeners = [
        'conversationSelected' => 'loadMessages'
    ];

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages($conversationId = null)
    {
        if ($conversationId) {
            $this->conversation = Conversation::findOrFail($conversationId);
            
            // Load messages with the sendable relationship, ordered by oldest first
            $this->messages = Message::where('conversation_id', $conversationId)
                ->with(['sendable' => function ($query) {
                    $query->select('id', 'name');
                }])
                ->forUser(auth()->id())
                ->notDeleted()
                ->oldest() // Show messages from top to bottom
                ->get();

            // Dispatch an event to scroll to latest message
            $this->dispatch('scrollToLatestMessage');
        } else {
            $this->conversation = null;
            $this->messages = collect([]);
        }
    }

    public function sendMessage()
    {
        if (!$this->conversation) {
            return;
        }

        // Handle message and file upload
        $messageData = [
            'body' => $this->message,
            'sendable_id' => auth()->id(),
            'sendable_type' => User::class
        ];

        if ($this->file) {
            $path = $this->file->store('messages', 'public');
            $messageData['file_path'] = $path;
            $messageData['file_name'] = $this->file->getClientOriginalName();
        }

        $message = $this->conversation->messages()->create($messageData);

        // Reset form
        $this->message = '';
        $this->file = null;

        $this->loadMessages($this->conversation->id);
    }

    public function render()
    {
        return view('livewire.wirechat.chat.chat-view');
    }
}
