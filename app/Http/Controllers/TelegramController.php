<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetTgPasswordRequest;
use App\Models\User;
use App\Telegram\Commands\StartCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        Telegram::bot('worker')->commandsHandler(true);
    }

    public function index(User $user)//Метод добавления чата пользователя в таблицу
    {   //Сохранение в кэш
        Cache::put('user_tg', $user->id, now()->addMinutes(2));
        //Перенаправление на бота
        return redirect('https://t.me/FinDiaryWorker_bot');

    }

    public function reset_show(Request $request)
    {
        $data = $request->validate(['email' => [
            'required',
            'email',
            Rule::exists('users','email'),
        ]]);

        return view('auth.passwords.reset-tg', compact('data'));
    }

    public function reset(ResetTgPasswordRequest $request)//Вынести в методы
    {
        $data = $request->validated();
        //Получение поля сбрасывающего кода
        $tgCode = User::query()
            ->select('reset_code')
            ->where('email', $data['email'])
            ->get();
        //Проверка кода
        if (!Hash::check($data['code'], $tgCode[0]->reset_code)) {
            return redirect()->route('login');
        }
        //Обновление пароля
        User::query()
            ->where('email', $data['email'])
            ->update([
                'password' => Hash::make($data['pass']),
                'reset_code' => null,
            ]);

        return redirect()->route('login');
    }
}
