<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

/*     public function getPermission($role_id) {

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
            'name' => 'required|string|max:255',
            'permissions' =>'string|nullable',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
        ]);

        if (!empty($validated['permissions'])) {
            if (is_array($validated['permissions'])) {
            
                $role->syncPermissions($validated['permissions']);
    
            } else {
                $role->givePermissionTo($validated['permissions']);
            }
        }
        
        return redirect(route('admin.roles.index'))->withErrors(['msg' => 'Khởi tạo Loại tại khoản '.$validated['name'].' thành công.']);
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
    public function edit(Role $role)
    {
        //
        $this->authorize('update', $role);

        return view('admin.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $this->authorize('update', $role);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' =>'string|nullable',
        ]);

        $role->update(['name' => $validated['name']]);

        return redirect(route('admin.roles.index'))->withErrors(['msg' => 'Cập nhật Loại tại khoản '.$validated['name'].' thành công.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $this->authorize('delete', $role);

        if ($role->name === "Super Admin") {
            return redirect(route('admin.roles.index'))->withErrors(['msg' => 'Khônng thể Xóa Loại tại khoản '.$role->name.'!']);
        }

        $role->delete();

        return redirect(route('admin.roles.index'))->withErrors(['msg' => 'Xóa Loại tại khoản '.$role->name.' thành công!']);
    }
}
