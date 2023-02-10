<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles', 'label' => 'Chỉnh sửa bài viết']);
        Permission::create(['name' => 'delete articles', 'label' => 'Xóa bài viết']);
        Permission::create(['name' => 'publish articles', 'label' => 'Xuất bản bài viết']);
        Permission::create(['name' => 'unpublish articles', 'label' => 'Ẩn bài viết']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $oriUser = Auth::user();

        $user = User::create(['name' => $oriUser->name, 'email' => $oriUser->email, 'password' => Hash::make('doimatkhaumacdinh')]);

        $user->assignRole($role);
    }
}
