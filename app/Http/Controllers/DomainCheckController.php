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

        try {
            CheckDomainJob::dispatch(json_encode($domain));
            flash()->success('Successfully started!');
        } catch (\Exception $exception) {
            flash()->error('Something was wrong');
            \Log::error($exception->getMessage(), $exception->getTrace());
        }

        return back();
    }
}
