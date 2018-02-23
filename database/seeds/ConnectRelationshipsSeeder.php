<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Get Available Permissions.
         */
        $permissions = Permission::all();

        $postPermissions = $permissions->whereIn('slug', ['create.post', 'edit.post', 'delete.post']);


     
        /**
        * Get Available Roles.
        */
        $roleAdmin = Role::where('slug', '=', 'admin')->first();
        $roleBusinessOwner = Role::where('slug', '=', 'business.owner')->first();
        $roleInvestor = Role::where('slug', '=', 'investor')->first();





        /**
         * Attach Permissions to Roles.
         */

        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

       

        
        foreach ($postPermissions as $permission) {
            $roleBusinessOwner->attachPermission($permission);
            $roleInvestor->attachPermission($permission);
        }
     
        


    }
}
