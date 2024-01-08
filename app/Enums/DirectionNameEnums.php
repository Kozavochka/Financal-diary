<?php

namespace App\Enums;

use Spatie\Enum\Enum;
/**
 * @method static self stocks()
 * @method static self funds()
 * @method static self bonds()
 * @method static self cryptos()
 * @method static self loans()
 * @method static self deposits()
 */
class DirectionNameEnums extends Enum
{
    protected static function values(): array
    {
        return [
            'stocks' => 'Акции',
            'bonds' => 'Облигации',
            'funds' => 'Фонды',
            'cryptos' => 'Криптовалюта',
            'loans' => 'Займы',
            'deposits' => 'Вклады'
        ];
    }
}
