<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }


        if (Role::where('slug', '=', 'business.owner')->first() === null) {
            $businessRole = Role::create([
                'name'        => 'Business Owner',
                'slug'        => 'business.owner',
                'description' => 'Business owner role',
                'level'       => 1,
            ]);
        }

        if (Role::where('slug', '=', 'Investor')->first() === null) {
            $investorRole = Role::create([
                'name'        => 'Investor',
                'slug'        => 'investor',
                'description' => 'Investor role',
                'level'       => 1,
            ]);
        }

    }
}
