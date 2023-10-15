<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{

    public function toArray($request)
    {
       return [
           'name' => $this->name,
           'ticker' => $this->ticker,
           'total_price' => $this->total_price,
           'industry_id' => $this?->industry_id,//Поменять
       ];
    }
}
