<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function index()
    {
        $domains = DB::table('domains')->get();

        $nullCheck = (object)[
            'created_at' => __('unknown'),
            'status_code' => __('unknown')
        ];

        $checks = $checks = DB::table('domain_checks')
            ->select(['domain_checks.domain_id', 'status_code', 'domain_checks.created_at'])
            ->join(DB::raw('(
                        select domain_id, MAX(id) as id
                        from domain_checks
                        GROUP BY domain_id
                    ) as temp'), 'domain_checks.id', '=', 'temp.id')
            ->join('domains', 'domain_checks.domain_id', '=', 'domains.id')
            ->get();

        return view('domains.index', [
            'domains' => $domains,
            'checks' => $checks->keyBy('domain_id'),
            'nullCheck' => $nullCheck
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
            flash(__('domain_exists'));
            return redirect()->route('domains.show', $domain->id);
        }

        $id = DB::table('domains')->insertGetId([
            'name' => $domainName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        flash(__('success'))->success();

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
