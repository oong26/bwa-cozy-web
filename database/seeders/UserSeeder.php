<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Oong', 'Khalil', 'Marceline'];
        $username = ['superadmin', 'admin', 'user'];
        $email = ['superadmin@gmail.com', 'admin@gmail.com', 'user@gmail.com'];
        $role = 1;
        for($i=0; $i < count($name); $i++){
            $user = new \App\Models\User;
            $user->name = $name[$i];
            $user->username = $username[$i];
            $user->email = $email[$i];
            $user->gender = 'M';
            $user->password = \Hash::make($username[$i]);
            $user->id_role = $role; 
            $user->save();
            $role+=1;
        }
    }
}
