<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_admin = [
            ['user-list', 'Доступ для просмотра списка всех сотрудников'],
            ['user-create', 'Доступ для создания нового сотрудника'],
            ['user-edit', 'Доступ для редактирования сотрудника'],
            ['user-delete', 'Доступ для удаления сотрудника'],
            ['role-create', 'Доступ для создания роли'],
            ['role-edit', 'Доступ для редактирования роли'],
            ['role-list', 'Доступ для просмотра списка всех ролей'],
            ['role-delete', 'Доступ для удаления роли'],
            ['permission-list', 'Доступ для просмотра списка всех доступов'],
            ['permission-create', 'Доступ для создания нового доступа'],
            ['permission-edit', 'Доступ для редактирования доступа'],
            ['permission-delete', 'Доступ для удаления доступа'],
            ['lead-import', 'Доступ для импорта лидов'],
            ['lead-export', 'Доступ для экспорта лидов'],
            ['lead-list', 'Доступ для просмотра лидов'],
            ['lead-create', 'Доступ для создания нового лида'],
            ['lead-edit', 'Доступ для редактирования лида'],
            ['lead-delete', 'Доступ для удаления лида']
        ];

        foreach($permissions_admin as $permission){
            Permission::create([
                'name' => $permission[0],
                'description' => $permission[1],
            ]);
        }

        // All Permissions
        $permission_saved = Permission::pluck('id')->toArray();

        // Give Role Admin All Access
        $role = Role::whereId(1)->first();
        $role->syncPermissions($permission_saved);

        // Admin Role Sync Permission
        $user = User::where('role_id', 1)->first();
        $user->assignRole($role->id);

        //#############################################################

        // Add permissions for Agent role (id = 2)
        $permissions_agent_ids = [1,15,16,17];

        foreach($permissions_agent_ids as $permission_id){
            DB::table('')->insert([
                'permission_id' => $permission_id,
                'role_id' => 2,
            ]);
        }

        //#############################################################

        // Add all permissions for Director role (id = 3)

        foreach($permission_saved as $permission_id){
            DB::table('')->insert([
                'permission_id' => $permission_id,
                'role_id' => 3,
            ]);
        }
    }
}
