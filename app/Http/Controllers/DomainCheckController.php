<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DomainCheckController extends Controller
{
    public function store(Request $request, $domainId)
    {
        $domain = DB::table('domains')->where('id', $domainId)->first();

        if (!$domain) {
            abort(404);
        }

        $response = Http::get("{$domain->name}");

        $check = [
            'domain_id' => $domain->id,
            'status_code' => $response->status(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('domain_checks')->insert($check);

        flash()->success('Successfully checked!');
        return back();
    }
}
