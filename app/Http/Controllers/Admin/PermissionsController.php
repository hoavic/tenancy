<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        $permissions = Permission::with('roles')->get();
        return view('admin.permissions.index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

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
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
        ]);

        Permission::create([
            'name' => $validated['name'],
            'label' => $validated['label'],
        ]);
 
        return redirect(route('admin.permissions.index'))->withErrors(['msg' => 'Khởi tạo Quyền '.$validated['label'].' thành công.']);
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
    public function edit(Permission $permission)
    {
        //
        $this->authorize('update', $permission);

        return view('admin.permissions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        $this->authorize('update', $permission);

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $permission->update($validated);

        return redirect(route('admin.permissions.index'))->withErrors(['msg' =>  'Chỉnh sửa Quyền '.$validated['label'].' thành công.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
        $this->authorize('delete', $permission);

        $permission->delete();

        return redirect(route('admin.permissions.index'))->withErrors(['msg' =>  'Xóa Quyền '.$permission->label.' thành công.']);

    }
}
