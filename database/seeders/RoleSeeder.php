<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleValue = ['Super Admin', 'Admin', 'User'];
        
        for($i=0;$i<count($roleValue); $i++){
            $role = new \App\Models\Role;
            $role->role = $roleValue[$i];
            $role->save();
        }
    }
}
