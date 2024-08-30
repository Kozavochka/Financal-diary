<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self annuity()
 * @method static self coupon()
 */
class LoanPaymentTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'annuity' => 'Аннуитет',
            'coupon' => 'Купонный',
        ];
    }
    public static function getTranslate($type): string
    {
        return self::values()[$type];
    }
}
