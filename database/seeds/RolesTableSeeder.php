<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'ROLE_ADMIN',
            'ROLE_READ',
            'ROLE_WRITE',
            'ROLE_DELETE'
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create([
                'name' => $role
            ]);
        }
    }
}
