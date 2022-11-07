<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PostSeeder::class
        ]);

        Permission::create(['name' => 'createPost']);
        Permission::create(['name' => 'updatePost']);
        Permission::create(['name' => 'deletePost']);
        Permission::create(['name' => 'viewPost']);
        Permission::create(['name' => 'viewProfile']);
        Permission::create(['name' => 'updateProfile']);

        $role = Role::create(['name' => 'superAdmin']);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'creator']);
        $role->syncPermissions(['createPost' , 'updatePost' , 'deletePost' , 'viewPost' , 'viewProfile' , 'updateProfile']);

        $user = User::find(1)->assignRole('superAdmin');
    }
}
