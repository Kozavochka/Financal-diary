<?php

namespace App\Jobs;

use App\Services\Telegram\Contracts\TelegramBotServiceContract;
use App\Services\Telegram\RegUserNotif;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Laravel\Facades\Telegram;

class RegisterUserProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        RegUserNotif::sendMessage($this->data);//Вызов статического метода отправки сообщения
    }
}
