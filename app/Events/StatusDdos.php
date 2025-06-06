<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StatusDdos implements ShouldBroadcastNow
{
    use InteractsWithSockets;

    public string $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function broadcastOn()
    {
        return new Channel('ddos-process-status');
    }

    public function broadcastAs()
    {
        return 'output';
    }
}
