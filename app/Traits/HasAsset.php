<?php

namespace App\Traits;

use App\Models\Bond;
use App\Models\Crypto;
use App\Models\Deposit;
use App\Models\Fund;
use App\Models\Loan;
use App\Models\Stock;

trait HasAsset
{
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function bonds()
    {
        return $this->hasMany(Bond::class);
    }

    public function funds()
    {
        return $this->hasMany(Fund::class);
    }

    public function cryptos()
    {
        return $this->hasMany(Crypto::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
   }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
   }

}
