<?php

namespace Homeful\Contacts\Events;

use Homeful\Contacts\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactPersisted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('contact.'.$this->contact->reference_code),
        ];
    }

    public function broadcastAs(): string
    {
        return 'contact.persisted';
    }

    public function broadcastWith(): array
    {
        return [
            'contact_reference_code' => $this->contact->reference_code,
        ];
    }
}
