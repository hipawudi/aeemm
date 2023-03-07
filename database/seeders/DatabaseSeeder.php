<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        // ]);

        $this->call([
            MemberSeeder::class,
            OrganizationSeeder::class
        ]);


        $roleMaster=Role::create(['name'=>'master','guard_name' => 'admin_web']);
        $roleAdmin=Role::create(['name'=>'admin','guard_name' => 'admin_web']);
        $roleTeacher=Role::create(['name'=>'teacher','guard_name' => 'admin_web']);
        $roleGuardian=Role::create(['name'=>'guardian','guard_name' => 'web']);
        $roleStudent=Role::create(['name'=>'student','guard_name' => 'web']);

        $permissionCourse=Permission::create(['name'=>'manage course','guard_name' => 'admin_web']);
        $permissionOffer=Permission::create(['name'=>'manage offer','guard_name' => 'admin_web']);
        $permissionTeacher=Permission::create(['name'=>'manage teacher','guard_name' => 'admin_web']);
        $permissionStudent=Permission::create(['name'=>'manage student','guard_name' => 'admin_web']);
        $permissionGuardian=Permission::create(['name'=>'manage guardian','guard_name' => 'admin_web']);
        $permissionAttendance=Permission::create(['name'=>'manage attendance','guard_name' => 'admin_web']);

        $roleMaster->givePermissionTo($permissionCourse);
        $roleMaster->givePermissionTo($permissionOffer);
        $roleMaster->givePermissionTo($permissionTeacher);
        $roleMaster->givePermissionTo($permissionStudent);
        $roleMaster->givePermissionTo($permissionGuardian);
        $roleMaster->givePermissionTo($permissionAttendance);

        $roleAdmin->givePermissionTo($permissionOffer);
        $roleAdmin->givePermissionTo($permissionTeacher);
        $roleAdmin->givePermissionTo($permissionStudent);
        $roleAdmin->givePermissionTo($permissionGuardian);
        $roleAdmin->givePermissionTo($permissionAttendance);

        $roleTeacher->givePermissionTo($permissionStudent);
        $roleTeacher->givePermissionTo($permissionAttendance);

        $admin=\App\Models\AdminUser::factory([
            'name' => 'Master',
            'email' => 'master@example.com',
            'password'=> Hash::make('password')
        ])->create();
        $admin->assignRole('master');

        $admin=\App\Models\AdminUser::factory([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('password')
        ])->create();
        $admin->assignRole('admin');

        $teacher=\App\Models\AdminUser::factory([
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password'=> Hash::make('password')
        ])->create();
        $teacher->assignRole('teacher');

        $student=\App\Models\User::factory([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password'=> Hash::make('password')
        ])->withPersonalTeam()->create();
        $student->assignRole('student');

    }
}
