<?php

namespace App\Events\App;

use App\Events\BaseEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
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
     */
    protected function getContext(): array
    {
        return [];
    }

    /**
     * Return subject
     */
    public function getSubject(): ?\Illuminate\Database\Eloquent\Model
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
