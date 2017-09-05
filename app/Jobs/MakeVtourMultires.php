<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Exception;

class MakeVtourMultires implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $cmd;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $cmd)
    {
        //
        $this->cmd = $cmd;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info("job exec: {$this->cmd}");
        exec($cmd, $output, $result);
        info("job status: $result");
    }

    public function failed(Exception $e)
    {
        // 发送失败通知, etc...
        info("job failt");
    }
}