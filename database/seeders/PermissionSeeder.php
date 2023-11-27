<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Nette\Utils\Arrays;
use Ramsey\Uuid\Uuid;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $allPermissions = array_unique(
            array_merge(
                config('general.permissions.system_admin_permissions'),
                config('general.permissions.system_user_permissions'),
                config('general.permissions.system_manager_permissions'),
            ),
            SORT_REGULAR
        );

        $data = collect($allPermissions)->map(function ($permission) {
            return [
                "id" => Uuid::uuid4()->toString(),
                "name" => $permission,
                "guard_name" => "api",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        });


        Permission::destroy(Permission::all()->pluck('id'));
        Permission::insert($data->toArray());
    }
}