<?php

namespace App\Events\App;

use App\Events\BaseEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicationStarted extends BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $id = 1;
    public string $name = 'Application Started';
    public string $level = 'notice';

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Return default event log context
     *
     * @return array
     */
    protected function getContext(): array
    {
        return [];
    }

    /**
     * Return subject
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getSubject(): \Illuminate\Database\Eloquent\Model|null
    {
        return null;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
