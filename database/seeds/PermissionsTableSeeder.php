<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * Add Permissions
         *
         */

        //-----------User Management

        if (Permission::where('name', '=', 'Can View Users')->first() === null) {
            Permission::create([
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'Can edit users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ]);
        }

        //-----------Post
        
        if (Permission::where('name', '=', 'Can Create Post')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Post',
                'slug'        => 'create.post',
                'description' => 'Can create post',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Post')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Post',
                'slug'        => 'edit.post',
                'description' => 'Can edit post',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Post')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Post',
                'slug'        => 'delete.post',
                'description' => 'Can delete post',
                'model'       => 'Permission',
            ]);
        }

        
    }
}
