<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Http;
use DB;

class CheckDomainJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $domain;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function handle()
    {
        $domain = json_decode($this->domain);
        $response = Http::get($domain->name);

        $check = [
            'domain_id' => $domain->id,
            'status_code' => $response->status(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('domain_checks')->insert($check);

        return $response->ok();
    }
}
