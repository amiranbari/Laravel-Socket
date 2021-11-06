<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExampleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private User $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }


    public function broadcastOn()
    {
        return new PresenceChannel('user');
    }

    public function broadcastWith()
    {
        return [
            'data' => [
                'message'   =>  $this->message,
                'user'      =>  $this->user->name
            ]
        ];
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'message.created';
    }

}
