<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "Super Admin",
            "System Admin",
            "Receptionist",
            "Employee",
            "Customer",
            "Management Staff",
        ];

        Role::destroy(Role::all()->pluck('id'));
        foreach ($roles as $role) {
            $role = Role::create([
                "id" => Uuid::uuid4()->toString(),
                "name" => $role,
                "guard_name" => "api",
            ]);
            if ($role->name == "Super Admin") {
                $role->syncPermissions(Permission::all());
            } else {
                $role->syncPermissions(config('general.permissions.' . strtolower(str_replace(" ", "_", $role)) . '_permissions'));
            }
        }
    }
}
