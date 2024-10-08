<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self deposit()
 * @method static self saving_account()
 */
class DepositTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'deposit' => 'Вклад',
            'saving_account' => 'Накопительный',
        ];
    }

    public static function getTranslate($type)
    {
        return self::values()[$type];
    }
}
