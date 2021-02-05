<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $title = 'Users';

    public function index()
    {
        $users = User::select('users.id', 'users.name', 'users.email', 'users.gender', 'users.id_role', 'role.id', 'role.role')
                    ->join('role', 'users.id_role', 'role.id')    
                    ->paginate(5);
                    
        return view('master.users.index',['users'=>$users] , ['title'=>$this->title]);
    }

    public function create()
    {
        # code...
    }

    public function edit($id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
