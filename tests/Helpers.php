<?php

namespace Tests\Helpers;
use DB;

function createFakeDomain(string $url): int
{
    return DB::table('domains')
        ->insertGetId([
            'name' => $url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
}

function createFakeChecks(int $domainId): int
{
        return DB::table('domain_checks')
            ->insertGetId([
                'domain_id' => $domainId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
}
