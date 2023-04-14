<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    //check domain and user tenant

    public function index(Request $request)
    {

        $project = $request->query('project');

        $domain = Domain::where('domain', '=', $project)->first();
        /* dd($domain); */
        if(empty($domain)) {
            return redirect()->route('client.dashboard');
        }

        $redirectUrl = '/web-admin/dashboard';

        $tenant = Tenant::find($domain->tenant_id);

        if($tenant->user_id != Auth::id()) {
            return redirect()->route('client.dashboard');
        }

        $token = tenancy()->impersonate($tenant, 1, $redirectUrl);

        return redirect($domain->getDomain().'/impersonate/'.$token->token);
    }

}
