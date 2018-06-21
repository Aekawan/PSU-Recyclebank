<?php

use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    DB::table('users')->insert(array(array(
        'firstname'     => 'ชาตชาย',
        'lastname' => 'ชาตรี',
        'username'    => '0123456789',
        'password' => Hash::make('0123456789'),
        'role' => 'admin',
        'is_admin' => 1
    ),array(
        'firstname'     => 'ชาเย็น',
        'lastname' => 'เย็นชา',
        'username'    => '5740000000',
        'password' => Hash::make('0123456789'),
        'role' => 'student'
    ),
    array(
        'firstname'     => 'ชาตตรี',
        'lastname' => 'มีดี',
        'username'    => '5740410000',
        'password' => Hash::make('0123456789'),
        'role' => 'student',
    )));
}

}
