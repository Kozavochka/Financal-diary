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

            $frontiersIntegrationService->syncReturnedLoans();
        }
        catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        DB::commit();
    }

    public function failed()
    {

    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array<int, string>
     */
    public function tags(): array
    {
        return ['integration', 'frontiers'];
    }
}
