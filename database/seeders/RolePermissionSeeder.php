<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = [
            'viewcourse',
            'createcourse',
            'editcourse',
            'deletecourse',
        ];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        $teacherRole= Role::create([
            'name' => 'teacher'
        ]);

        $teacherRole->givePermissionTo([
            'viewcourse',
            'createcourse',
            'editcourse',
            'deletecourse',
        ]);

        $studentRole= Role::create([
            'name' => 'student'
        ]);

        $studentRole->givePermissionTo([
            'viewcourse',
        ]);

        //membuat data super admin 
        $user = User::create([
            'name' => 'Fanny',
            'email' => 'fanny@smayapem.com',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole($teacherRole);
    }
}
