<?php

namespace Database\Seeders;

use App\Models\CleaningService;
use App\Models\Responsibility;
use App\Models\User;
use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        CleaningService::factory()->count(15)->create();
        Permission::create(array('name'=>'cs-can', 'guard_name'=> 'web'));
        Permission::create(array('name'=>'manager-can', 'guard_name'=> 'web'));
        Role::create(array('name'=>'cleaning_service', 'guard_name'=>'web'));
        Role::create(array('name'=>'manager', 'guard_name'=>'web'));
        Responsibility::factory()->count(50)->create();
        $user = new User();
        $user->name = "Admin Kokeru";
        $user->email = "admin@kokeru.app";
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole('manager');

        $user = new User();
        $user->name = "Robert Angkaraharja";
        $user->email = "cs@kokeru.app";
        $user->password = bcrypt('password');
        $user->cleaning_service_id = 1;
        $user->save();
        $user->assignRole('cleaning_service');

    }
}
