<?php

namespace App\Events;

use App\Models\BibleNewProgram;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class Mp3Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $program;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($program)
    {
        $this->program = $program;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
