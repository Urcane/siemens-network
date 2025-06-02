<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class StatusNmap implements ShouldBroadcastNow
{
    use InteractsWithSockets;

    public string $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function broadcastOn()
    {
        return new Channel('nmap-process-status');
    }

    public function broadcastAs()
    {
        return 'output';
    }
}
