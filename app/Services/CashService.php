<?php

namespace App\Services;

use App\Models\Cash;
use App\Models\ChangeHistory;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class CashService
{
    public function transferToCash($cashId, Income $income)
    {
        DB::beginTransaction();
        try {
            Cash::query()
                ->where('id',$cashId)
                ->increment('sum',$income->price);

            ChangeHistory::query()
                ->create([
                    'sum' => $income->price,
                    'cash_id' => $cashId,
                    'change_reason_id' => $income->id,
                    'change_reason_type' => $income->getMorphClass(),
                ]);
        }
        catch (\Exception $exception){
            DB::rollBack();

            throw $exception;
        }
        DB::commit();

    }
}
