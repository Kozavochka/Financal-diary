<?php

namespace App\Services\Telegram\Contracts;

interface TelegramBotServiceContract
{
    public function sendRedisterUser(array $data);
}
