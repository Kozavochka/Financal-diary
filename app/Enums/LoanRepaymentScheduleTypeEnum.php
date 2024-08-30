<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self quarterly()
 * @method static self monthly()
 */
class LoanRepaymentScheduleTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'quarterly' => 'Ежеквартально',
            'monthly' => 'Ежемесячно',
        ];
    }

    public static function getTranslate($type): string
    {
        return self::values()[$type];
    }

}
