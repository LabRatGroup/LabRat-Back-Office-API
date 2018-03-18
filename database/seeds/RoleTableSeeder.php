<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'description'        => 'Staff member',
            'alias'              => 'staff',
            'role_type'          => 'staff',
            'root'               => true,
            'security_clearance' => null,
        ]);

        Role::create([
            'description'        => 'Super administrator',
            'alias'              => 'super-admin',
            'role_type'          => 'staff',
            'root'               => false,
            'security_clearance' => 110,
        ]);

        Role::create([
            'description'        => 'Senior staff member',
            'alias'              => 'senior-staff',
            'role_type'          => 'staff',
            'root'               => false,
            'security_clearance' => 120,
        ]);

        Role::create([
            'description'        => 'Junior staff member',
            'alias'              => 'junior-staff',
            'role_type'          => 'staff',
            'root'               => false,
            'security_clearance' => 130,
        ]);

        Role::create([
            'description'        => 'Registered user',
            'alias'              => 'registered-user',
            'role_type'          => 'user',
            'root'               => true,
            'security_clearance' => null,
        ]);

        Role::create([
            'description'        => 'Registered user',
            'alias'              => 'system-user',
            'role_type'          => 'user',
            'root'               => false,
            'security_clearance' => 210,
        ]);

        Role::create([
            'description'        => 'Project Roles',
            'alias'              => 'project-roles',
            'role_type'          => 'project',
            'root'               => true,
            'security_clearance' => null,
        ]);

        Role::create([
            'description'        => 'Project administrator',
            'alias'              => 'project-admin',
            'role_type'          => 'project',
            'root'               => false,
            'security_clearance' => 310,
        ]);

        Role::create([
            'description'        => 'Project manager',
            'alias'              => 'project-manager',
            'role_type'          => 'project',
            'root'               => false,
            'security_clearance' => 320,
        ]);

        Role::create([
            'description'        => 'Project user',
            'alias'              => 'project-user',
            'role_type'          => 'user',
            'root'               => false,
            'security_clearance' => 330,
        ]);
    }
}
