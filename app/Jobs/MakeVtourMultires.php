<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MakeVtourMultires implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $inputPath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inputPath)
    {
        //
        $this->inputPath = $inputPath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $root_path = "/mnt/vdb1/mkpano/krpano-1.19-pr10";
        $cmd = $root_path . "/make.sh " . $this->$inputPath . " ";
        info("job exec: {$cmd}");
        exec($cmd, $output, $result);
        info("job status: $result");
    }
}
