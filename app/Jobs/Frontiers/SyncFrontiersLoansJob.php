<?php

namespace App\Jobs\Frontiers;

use App\Services\Integrations\Frontiers\FrontiersIntegrationServiceContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SyncFrontiersLoansJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FrontiersIntegrationServiceContract $frontiersIntegrationService)
    {
        DB::beginTransaction();

        try {
            $frontiersIntegrationService->syncLoans();
        }
        catch (\Throwable $exception) {
            DB::rollBack();
            dump(123);
            throw $exception;
        }

        DB::commit();
    }

    public function failed()
    {

    }
}
