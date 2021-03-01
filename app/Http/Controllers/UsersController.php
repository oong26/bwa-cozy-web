<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                $this->param['users'] = User::select('users.id', 'users.name', 'users.email', 'users.gender', 'users.profile_photo_url', 'role.id AS role_id', 'role.role')
                ->join('role', 'users.id_role', 'role.id')    
                ->where('users.name', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('role.role', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('users.email', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('users.gender', 'LIKE', '%'.$req->get('s').'%')
                ->paginate(5);
            }
            else{ // if search is null
                $this->param['users'] = User::select('users.id', 'users.name', 'users.email', 'users.gender', 'users.profile_photo_url', 'role.id AS role_id', 'role.role')
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
        $this->param['subtitle'] = 'Add new User';
        $this->param['role'] = Role::all();
        return view('master.users.create', $this->param);
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|min:6|max:50',
            'username' => 'required|min:4|max:20|unique:users,username',
            'email' => 'required|unique:users,email',
            'gender' => 'required',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'
        ]);
        try{
            $profile = $req->file('profile');
            $newUser = new User;
            $newUser->name = $req->get('name');
            $newUser->email = $req->get('email');
            $newUser->username = $req->get('username');
            $newUser->gender = $req->get('gender');
            $newUser->password = Hash::make($req->get('password'));
            $newUser->id_role = $req->get('role');
            
            $newUser->save();

            if($profile != null && $newUser->save()){
                $filename = date('His').$newUser->id.'.'.$req->file('profile')->extension(); 
                if($profile->move('assets/uploaded_files/profiles', $filename)){
                    $upPhoto = User::findOrFail($newUser->id);
                    $upPhoto->profile_photo_url = $filename;
                    $upPhoto->save();
                }
                else{
                    alert()->error("Can't upload the image photo.", 'Error');
                }
            }
            
            alert()->success('Successfully added data', 'Success')->autoclose(2000);
            return redirect('master/users/users');
        }
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try{
            $this->param['title'] = 'Edit';
            $this->param['subtitle'] = 'Change your current user';
            $this->param['role'] = Role::all();
            $this->param['user'] = User::find($id);

            return view('master.users.edit', $this->param);
        }   
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
    }

    public function update($id, Request $req)
    {
        $req->validate([
            'name' => 'required|min:6|max:50',
            'gender' => 'required',
            'role' => 'required|not_in:',
        ]);
        try{
            $profile = $req->file('profile');
            $updateUser = User::findOrFail($id);
            $updateUser->name = $req->get('name');
            $updateUser->gender = $req->get('gender');
            $updateUser->id_role = $req->get('role');
            
            if(!is_null($req->get('birthday'))){
                $updateUser->birthday = $req->get('birthday');
            }

            if(!is_null($req->get('phone'))){
                if($req->get('phone') != $updateUser->phone){
                    $updateUser->phone = $req->get('phone');
                }
                else{
                    return redirect()->back()->withErrors('Phone number is already registered');
                }
            }

            if(!is_null($req->get('address'))){
                $updateUser->address = $req->get('address');
            }

            $updateUser->save();

            if($profile != null && $updateUser->save()){
                $filename = date('His').$id.'.'.$req->file('profile')->extension(); 
                if($profile->move('assets/uploaded_files/profiles', $filename)){
                    $upPhoto = User::findOrFail($updateUser->id);
                    $upPhoto->profile_photo_url = $filename;
                    $upPhoto->save();
                }
                else{
                    alert()->error("Can't upload the image photo.", 'Error');
                }
            }
            
            alert()->success('Successfully added data', 'Success')->autoclose(2000);
            return redirect('master/users/users');
        }
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
    }

    public function changePassword($id)
    {
        $this->param['title'] = 'Change Password';
        $this->param['subtitle'] = 'Add new User';
        $this->param['user_id'] = $id;
        
        return view('master.users.change-password', $this->param);
    }

    public function updatePassword(Request $req, $id)
    {
        try{
            $req->validate([
                'old_password' => 'required|min:4',
                'new_password' => 'required|min:4'
            ]);

            $user = User::findOrFail($id);
            
            if(Hash::check($req->get('old_password'), $user->password)){
                $user->password = Hash::make($req->get('new_password'));
                $user->save();
                alert()->success("Password has changed", 'Success')->autoclose(3000);
                return redirect()->route('users');
            }
            else{
                alert()->error("Old password doesn't match", 'Validation Error');
                return redirect()->back();
            }
        }
        catch(Exception $e){
            return $e->getMessage();
            alert()->error($e->getMessage(), 'Error');
        }
        catch(\Illuminate\Database\QueryException $e){
            return $e->getMessage();
            alert()->error($e->getMessage(), 'Database Error');
        }
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $photo = $user->profile_photo_url;
            $path = public_path().'/assets/uploaded_files/profiles/'.$photo;
            if($photo != null){
                if(file_exists($path)){
                    \File::delete('assets/uploaded_files/profiles/'.$photo);
                    $user->delete();
                }
            }

            alert()->success('Successfully added data', 'Success')->autoclose(2000);
            return redirect('master/users/users');
        }
        catch(Exception $e){
            return $e->getMessage();
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            return $e->getMessage();
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }

    }
}
