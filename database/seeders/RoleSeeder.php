<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'label' => 'Администратор',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Agent',
            'label' => 'Агент',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Director',
            'label' => 'Директор',
            'guard_name' => 'web',
        ]);
    }
}
