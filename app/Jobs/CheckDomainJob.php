<?php

namespace App\Jobs;

use DiDom\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Http;
use DB;

class CheckDomainJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $domain;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    public function handle()
    {
        $domain = json_decode($this->domain);

        try {
            $response = Http::get($domain->name);
        } catch (ConnectionException | RequestException $exception) {
            flash('Could not check url');
            return false;
        }

        $document = new Document($response->body());
        $h1 = $document->first('h1');
        $description = $document->first('meta[name="description"]');
        $keywords = $document->first('meta[name="keywords"]');

        $check = [
            'domain_id' => $domain->id,
            'status_code' => $response->status(),
            'keywords' => optional($keywords)->attr('content'),
            'h1' => optional($h1)->text(),
            'description' => optional($description)->attr('content'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('domain_checks')->insert($check);

        return $response->ok();
    }
}
