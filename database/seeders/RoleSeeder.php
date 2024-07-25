<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Administrator',
            'Officer',
            'External Personnel',
        ];
        
        foreach ($roles as $role_name){
            Role::create([
                'role_name' => $role_name,
            ]);
        }
    }
}
