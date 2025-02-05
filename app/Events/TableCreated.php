<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\TableLayout;

class TableCreated implements ShouldBroadcastNow
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
        return 'table.created';
    }

    public function broadcastWith()
    {
        return [
            'table_id' => $this->table->table_id,
            'table_name' => $this->table->table_name,
            'x_position' => $this->table->x_position,
            'y_position' => $this->table->y_position,
            'status' => $this->table->status ?? 'free'
        ];
    }
}
