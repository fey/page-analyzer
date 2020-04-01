<?php

namespace App\Http\Controllers;

use App\Jobs\CheckDomainJob;
use DB;

class DomainCheckController extends Controller
{
    public function store($domainId)
    {
        $domain = DB::table('domains')->where('id', $domainId)->first();

        if (!$domain) {
            abort(404);
        }

        try {
            CheckDomainJob::dispatch(json_encode($domain));
            flash()->success(__('started'));
        } catch (\Exception $exception) {
            flash()->error(__('something_wrong'));
            \Log::error($exception->getMessage(), $exception->getTrace());
        }

        return back();
    }
}
