<?php

namespace Database\Seeders;

use App\Http\Services\RolePermissionService;
use App\Models\User;
use App\Traits\JsonResponseTrait;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $permissions = permissionArrayList();
        $this->createPermissions($permissions);

        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $admin = User::where('role', USER_ROLE_ADMIN)->first();
        $admin->syncRoles($role->id);
    }

    private function createPermissions(array $permissions, $prefix = null)
    {
        foreach ($permissions as $key => $value) {
            if (is_array($value)) {
                $this->createPermissions($value, $key);
            } else {
                $name = $prefix ? "{$prefix}.{$value}" : $value;
                Permission::firstOrCreate(['name' => $name]);
            }
        }
    }
}
