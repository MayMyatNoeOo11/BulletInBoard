<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        for($i=1;$i<10;$i++)
        {
            DB::table('users')->insert([
                'name' => 'User '.$i,
                'email' => Str::random(7).'@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '0979895623'.$i,
                'address' => Str::random(50),
                'profile_photo' => 'D:\MayMyatNoeOo\images\img'.$i.'.jpg',
                'date_of_birth' => '1996-11-07',
                'created_at'=>now(),
                'updated_at'=>now(),
                'created_user_id'=>'1',
                'updated_user_id'=>'1'
            ]);
        }
    }
}
