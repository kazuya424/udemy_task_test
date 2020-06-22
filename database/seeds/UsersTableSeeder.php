<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'aaa',
                'email' => 'test@gmail.com',
                'password' => Hash::make('123123123'), //暗号化
            ], [
                'name' => 'bbb',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('123123123'), //暗号化
            ], [
                'name' => 'ccc',
                'email' => 'test2@gmail.com',
                'password' => Hash::make('123123123'), //暗号化
            ]
        ]);
    }
}
