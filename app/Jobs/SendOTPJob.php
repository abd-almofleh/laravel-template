<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOTPJob implements ShouldQueue
{
  use Dispatchable;
  use InteractsWithQueue;
  use Queueable;
  use SerializesModels;

  private string $code;
  private string $phone_number;

  /**
   * Create a new job instance.
   */
  public function __construct(string $phone_number, string $code)
  {
    $this->code = $code;
    $this->phone_number = $phone_number;
  }

  /**
   * Execute the job.
   */
  public function handle()
  {
    error_log('Your one time password is: ' . $this->code);
  }
}
