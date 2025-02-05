<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\TableLayout;

class TableUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $table;

    public function __construct(TableLayout $table)
    {
        $this->table = $table;
    }

    public function broadcastOn()
    {
        return new Channel('tables');
    }

    public function broadcastAs()
    {
        return 'table.updated';
    }
}
