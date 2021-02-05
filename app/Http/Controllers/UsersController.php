<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Users';
    }

    public function index(Request $req)
    {
        try{
            if(!empty($req->get('s'))){ // if search is not null
                // Search data
                $this->param['users'] = User::select('users.id', 'users.name', 'users.email', 'users.gender', 'users.id_role', 'role.id', 'role.role')
                ->join('role', 'users.id_role', 'role.id')    
                ->where('users.name', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('role.role', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('users.email', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('users.gender', 'LIKE', '%'.$req->get('s').'%')
                ->paginate(5);
            }
            else{ // if search is null
                $this->param['users'] = User::select('users.id', 'users.name', 'users.email', 'users.gender', 'users.id_role', 'role.id', 'role.role')
                    ->join('role', 'users.id_role', 'role.id')    
                    ->paginate(5);
            }
        }
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
        finally{
            return view('master.users.index', $this->param);
        }
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
