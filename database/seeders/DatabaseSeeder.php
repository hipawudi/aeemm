<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ConfigSeeder::class,
            CourseSeeder::class,
            OfferSeeder::class,
            RoomSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ]);


        $roleMaster=Role::create(['name'=>'master']);
        $roleAdmin=Role::create(['name'=>'admin']);
        $roleTeacher=Role::create(['name'=>'teacher']);
        $roleGuardian=Role::create(['name'=>'guardian']);
        $roleStudent=Role::create(['name'=>'student']);

        $permissionCourse=Permission::create(['name'=>'manage course']);
        $permissionOffer=Permission::create(['name'=>'manage offer']);
        $permissionTeacher=Permission::create(['name'=>'manage teacher']);
        $permissionStudent=Permission::create(['name'=>'manage student']);
        $permissionGuardian=Permission::create(['name'=>'manage guardian']);
        $permissionAttendance=Permission::create(['name'=>'manage attendance']);

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

        $admin=\App\Models\User::factory([
            'name' => 'Master',
            'email' => 'master@example.com',
            'password'=> Hash::make('password')
        ])->withPersonalTeam()->create();
        $admin->assignRole('master');

        $admin=\App\Models\User::factory([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('password')
        ])->withPersonalTeam()->create();
        $admin->assignRole('admin');

        $teacher=\App\Models\User::factory([
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password'=> Hash::make('password')
        ])->withPersonalTeam()->create();
        $teacher->assignRole('teacher');

    }
}
