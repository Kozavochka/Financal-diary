<?php

namespace App\Events;

use App\Jobs\ExportAllPdfProcess;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportAllPdf
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct($data)
    {
        ExportAllPdfProcess::dispatch($data);//Создание job на генерацию pdf
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
