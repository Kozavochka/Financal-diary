<?php

namespace App\Jobs\Statistic;

use App\Services\Statistic\TotalStatisticServiceContract;
use Illuminate\Bus\Queueable;;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateDynamicStatisticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $service;

    protected int $userId;
    public function __construct(int $userId)
    {
        $this->service = app()->make(TotalStatisticServiceContract::class);
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->service
            ->setUserId($this->userId)
            ->calculate();
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array<int, string>
     */
    public function tags(): array
    {
        return ['statistic', 'dynamic'];
    }
}
