<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        \App\Business::create([
            'name'                           => 'businessName1',
            'nature'                     => 'businessNature1',
            'address'                      => 'businessAdd1',
            'user_id'                          => 1,
        ]);
    }
}
