<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Exception;
use Laravel\Jetstream\Role as JetstreamRole;

class RoleController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Role';
    }

    public function index(Request $req)
    {
        try{
            if(!empty($req->get('s'))){ // if search is not null
                // Search data
                $this->param['role'] = Role::where('role','LIKE', '%'.$req->get('s').'%')->paginate(5);
            }
            else{// if search is null 
                $this->param['role'] = Role::select('id', 'role')->paginate(5);
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
            return view('master.role.index', $this->param);
        }
    }

    public function create()
    {
        $this->param['subtitle'] = 'Add new Role';
        return view('master.role.create', $this->param);
    }

    public function store(Request $req)
    {
        $validatedData = $req->validate([
            'role' => 'required',
        ]);
        try{
            $role = $req->get('role');
            $newRole = new Role;

            $newRole->role = $role;
            $newRole->save();

            alert()->success('Successfully added data', 'Success')->autoclose(2000);

            return redirect('master/role');
        }
        catch(\Exception $e){
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
            $this->param['subtitle'] = 'Change your current role';
            $this->param['role'] = Role::where('id', $id)->first();

            return view('master.role.edit', $this->param);
        }
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $e) {
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
    }

    public function update($id, Request $req)
    {
        $validatedData = $req->validate([
            'role' => 'required|unique:role,role',
        ]);
        try{
            $updateRole = Role::find($id);
            if($req->get('role') != $updateRole->role){
                $updateRole->role = $req->get('role');
                $updateRole->save();
            }

            alert()->success('Successfully updated data', 'Success')->autoclose(2000);
            return redirect('master/role/');
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

    public function destroy($id)
    {
        try{
            $role = Role::findOrFail($id);

            $role->delete();

            alert()->success('Successfully delete data', 'Success')->autoclose(2000);

            return redirect()->back()->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }   
    }
}
