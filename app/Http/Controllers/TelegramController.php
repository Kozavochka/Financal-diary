<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Telegram\Commands\StartCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Telegram::bot('worker')->commandsHandler(true);
    }

    public function index(User $user)
    {
        Cache::put('user_tg', $user->id, $minutes = 10);

        return redirect('https://t.me/FinDiaryWorker_bot');

    }
}
