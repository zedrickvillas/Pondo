<?php

use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet')->insert([
            'balance' => value(0),
            'user_id' => value(1),
        ]);
        DB::table('wallet')->insert([
            'balance' => value(0),
            'user_id' => value(2),
        ]);
    }
}
