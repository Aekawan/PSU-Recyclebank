<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Eloquent::unguard();

         $this->call('GarbageTableSeeder');
         $this->call('UserTableSeeder');
         $this->command->info('User Table Seeded!');
    }
}

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    DB::table('users')->insert(array(array(
        'firstname'     => 'แอดมิน',
        'lastname' => 'ผู้ดูแลระบบ',
        'email' => 'vachiravit077@gmail.com',
        'username'    => '0123456789',
        'password' => Hash::make('0123456789'),
        'role' => 'admin',
        'remember_token' => '',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'is_admin' => 1
    ),array(
        'firstname'     => 'ชาเย็น',
        'lastname' => 'เย็นชา',
        'email' => 'l3anksingle123@gmail.com',
        'username'    => '5740000000',
        'password' => Hash::make('0123456789'),
        'role' => 'student',
        'remember_token' => '',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'is_admin' => 0
    ),
    array(
        'firstname'     => 'ชาตตรี',
        'lastname' => 'มีดี',
        'email' => 's5730213083@phuket.psu.ac.th',
        'username'    => '5740410000',
        'password' => Hash::make('0123456789'),
        'role' => 'student',
        'remember_token' => '',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'is_admin' => 0
    )));
}

}



class GarbageTableSeeder extends Seeder
{

public function run()
{
    DB::table('garbages')->delete();
    DB::table('garbages')->insert(array(
     array(
        'type'     => '0',
        'purchase_price' => 0,
        'detail'    => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ),
    array(
        'type'     => 'ขวดพลาสติก',
        'purchase_price' => 3,
        'detail'    => 'ขวดพลาสติดใส',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ),
    array(
      'type'     => 'กระดาษ',
      'purchase_price' => 2,
      'detail'    => 'กระดาษสมุด',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ),
    array(
      'type'     => 'กระดาษลัง',
      'purchase_price' => 2,
      'detail'    => 'กระดาษลัง',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    )));
}

}
