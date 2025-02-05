<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class TableDeleted implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $tableId;

    public function __construct($tableId)
    {
        $this->tableId = $tableId;
    }

    public function broadcastOn()
    {
        return new Channel('tables');
    }

    public function broadcastAs()
    {
        return 'table.deleted';
    }

    public function broadcastWith()
    {
        return [
            'table_id' => $this->tableId
        ];
    }
}
