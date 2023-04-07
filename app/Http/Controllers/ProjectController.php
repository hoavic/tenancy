<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Database\Models\Domain;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tenants = Tenant::where('user_id', '=', Auth::id())->latest()->get();
        
        return view('client.projects.index',[
            'tenants' => $tenants,
        ]);
    }

/*     public static function getDomain($tenant_id) {
        $domain_arr = Domain::where('tenant_id', $tenant_id)->first();

        if (empty($domain_arr)) {return;}

        $domain = $domain_arr->domain;
        if ($domain_arr->domain_type === "subdomain") {
            $domain = $domain_arr->domain.'.'.config('tenancy.central_domains')[0];
        }
        return 'http://'.$domain;
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'domain_type' => 'required|string|max:255',
            'project_domain' => 'required|string|max:255',
            'plan' => 'required|string|max:255',
        ]);

        
        $domain = $validated['project_domain'];

        // check tentant id

        $domainIsExist = Domain::select("*")
            ->where("domain", $domain)
            ->exists();

        if ($domainIsExist) {
            return redirect(route('client.projects.index'))->withErrors(['msg' => 'Tên miền đã tồn tại.']);
        }

        
/*         $domainIsExist = Domain::select("*")
            ->where("domain", $domain)
            ->exist();

        if ($domainIsExist) {
            return redirect(route('projects.index'))->withErrors(['msg' => 'Tên miền đã tồn tại.']);
        }   */  

        $domain_type = $validated['domain_type'];
        $plan = $validated['plan'];

/*         if ($domain_type === 'subdomain') {
            $domain = $validated['project_domain'].'.tenancy.test';
        }  */

        $tenant = $request->user()->tenants()->create([
            'name' => $validated['project_name'],
            'status' => 'publish',
            'plan' => $plan,
            'user_id' => Auth::id()
        ]);

        $tenant->domains()->create([
            'domain' => $domain,
            'domain_type' => $domain_type,
        ]);
 
        return redirect(route('client.projects.index'))->withErrors(['msg' => 'Khởi tạo dự án thành công.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $project)
    {
        //
        $this->authorize('delete', $project);

        $project->delete();

        return redirect(route('client.projects.index'))->withErrors(['msg' => 'Xóa dự án '.$project->name.' thành công.']);
    }
}
