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
        Cache::put('user_tg', $user->id, $minutes = 10);

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
        dump(Cache::get('reset_code'));
       /* if($tgCode !== $data['code']){
            return redirect()->back();
        }*/
        dd($data);
        User::query()
            ->where('email', $data['email'])
            ->update([
                'password' => Hash::make($data['pass'])
            ]);

        Cache::forget('reset_code');

        return redirect()->route('login');
    }
}
