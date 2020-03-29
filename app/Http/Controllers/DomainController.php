<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function index()
    {
        $domains = DB::table('domains')->get();

        $checks = DB::table('domain_checks')->orderBy('created_at')->get();

        return view('domains.index', [
            'domains' => $domains,
            'checks' => $checks->keyBy('domain_id')
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['domain.name' => 'required|url']);
        $domainName = $this->getDomainFromUrl(
            $request->input('domain.name')
        );

        $domain = DB::table('domains')->where('name', $domainName)->first();

        if ($domain) {
            flash('Domain already exists');
            return redirect()->route('domains.show', $domain->id);
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domainName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        flash('Success created')->success();

        return redirect()->route('domains.show', $id);
    }

    public function show($id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();

        if (!$domain) {
            return abort(404);
        }

        $checks = DB::table('domain_checks')->where('domain_id', $id)->orderByDesc('created_at')->get();
        $lastCheck = array_first($checks);

        return view('domains.show', compact('domain', 'checks', 'lastCheck'));
    }

    private function getDomainFromUrl(string $url): string
    {
        return strtolower(parse_url($url, PHP_URL_HOST));
    }
}
