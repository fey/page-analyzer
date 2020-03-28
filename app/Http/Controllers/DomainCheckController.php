<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DomainCheckController extends Controller
{
    public function store(Request $request, $domainId)
    {
        $check = [
            'domain_id' => $domainId,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('domain_checks')->insert($check);

        flash()->success('Successfully checked!');
        return back();
    }
}
