<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function index()
    {
        $domains = DB::table('domains')->get();

        $checks = DB::table('domain_checks')
            ->select(DB::raw('distinct on (domain_id) domain_id, status_code, created_at'))
            ->orderByDesc('domain_id')
            ->orderByDesc('created_at')
            ->get();

        return view('domains.index', [
            'domains' => $domains,
            'checks' => $checks->keyBy('domain_id')
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'domain' => 'required|url',
        ]);
        $domain = strtolower(parse_url($request->domain, PHP_URL_HOST));

        $isExistsDomain = DB::table('domains')->where('name', $domain)->exists();

        if ($isExistsDomain === false) {
            DB::table('domains')->insert([
                    'name' => $domain,
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);
            flash('Success created')->success();
        } else {
            flash('Domain already exists')->warning();
        }

        return back();
    }

    public function show($id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();

        if (!$domain) {
            return abort(404);
        }

        $checks = DB::table('domain_checks')
            ->where('domain_id', $id)
            ->orderByDesc('created_at')
            ->get();
        $lastCheck = array_first($checks);

        return view('domains.show', compact('domain', 'checks', 'lastCheck'));
    }
}
