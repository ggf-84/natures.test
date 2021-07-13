<?php

namespace App\Events;

use App\Donation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClientNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $donation;
    public $locale;

    /**
     * Create a new event instance.
     * @var Donation $donation
     *
     * @return void
     */
    public function __construct(Donation $donation, $locale)
    {
        $this->donation = $donation;
        $this->locale = $locale;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
