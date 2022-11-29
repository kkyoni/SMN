<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'created_by' => '1',
            'user_type_id'=> '1',
            'name' => 'Our Vatav',
            'code' => 'VAT',
        	'username' => 'maet1947',
            'password' => bcrypt('123456'),
            'image' => 'default.png',
            'status' => '1',
            'is_head_office' => '1',
            'is_verified' => '0',
        ]);
    }
}