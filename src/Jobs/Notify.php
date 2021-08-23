<?php

namespace Kyawthet\ErrorShout\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kyawthet\ErrorShout\Models\Notify;

class Notify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $notify;

    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    public function handle()
    {
        // $this->notify->publish();
    }
}
