<?php

namespace App\Enums;

use Spatie\Enum\Enum;
/**
 * @method static self deposit()
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
}
