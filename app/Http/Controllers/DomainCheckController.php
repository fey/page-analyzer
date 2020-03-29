<?php

namespace App\Http\Controllers;

use App\Jobs\CheckDomainJob;
use DB;
use Illuminate\Http\Request;

class DomainCheckController extends Controller
{
    public function store(Request $request, $domainId)
    {
        $domain = DB::table('domains')->where('id', $domainId)->first();

        if (!$domain) {
            abort(404);
        }

        CheckDomainJob::dispatch(json_encode($domain));

        flash()->success('Successfully started!');
        return back();
    }
}
