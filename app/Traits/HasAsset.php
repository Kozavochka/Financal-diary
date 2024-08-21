<?php

namespace App\Traits;

use App\Models\Assets\Bond;
use App\Models\Assets\Crypto;
use App\Models\Assets\Deposit;
use App\Models\Assets\Fund;
use App\Models\Assets\Loan;
use App\Models\Assets\Stock;

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
