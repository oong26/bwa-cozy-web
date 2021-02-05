<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Exception;

class RoleController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Role';
    }

    public function index()
    {
        $role = Role::select('id', 'role')->paginate(5);
        return view('master.role.index',['role'=>$role], $this->param);
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

            return redirect('master/role');
        }
        catch(\Exception $e){
            return $e->getMessage();
            return redirect()->back()->withStatus('Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return $e->getMessage();
            return redirect()->back()->withStatus('Terjadi kesalahan pada database : '. $e->getMessage());
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
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }
    }

    public function update($id, Request $req)
    {
        $validatedData = $req->validate([
            'role' => 'required',
        ]);
        try{
            $updateRole = Role::find($id);
            $updateRole->role = $req->get('role');
            $updateRole->save();

            return redirect('master/role');
        }
        catch(Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());

        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try{
            $role = Role::findOrFail($id);

            $role->delete();

            return redirect()->back()->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }   
    }
}
