<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetTgPasswordRequest;
use App\Models\User;
use App\Telegram\Commands\StartCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
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
        Cache::put('user_tg', $user->id, now()->addMinutes(2));

        return redirect('https://t.me/FinDiaryWorker_bot');

    }

    public function reset_show(Request $request)
    {       $data = $request->validate(['email' => 'required|email']);

            return view('auth.passwords.reset-tg', compact('data'));
    }

    public function reset(ResetTgPasswordRequest $request)
    {
        $data = $request->validated();

        $tgCode = Cache::get('reset_code');
        //Проверка кода
        if($tgCode !== intval( $data['code'],$base = 10)){
            return redirect()->route('login');
        }
        //Обновление пароля
        User::query()
            ->where('email', $data['email'])
            ->update([
                'password' => Hash::make($data['pass'])
            ]);
        //Очищение кэша
        Cache::forget('reset_code');

        return redirect()->route('login');
    }
}
