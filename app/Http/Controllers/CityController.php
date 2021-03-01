<?php

namespace App\Http\Controllers;

use App\Models\City;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'City';
    }

    public function index(Request $req)
    {
        try{
            if(!is_null($req->get('s'))){
                $city = City::select('id', 'name')->where('name', 'LIKE', '%'.$req->get('s').'%')->orderBy('name', 'ASC')->paginate(5);
            }
            else{
                $city = City::select('id', 'name')->orderBy('name', 'ASC')->paginate(5);
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
        return view('master.city.index',['city'=>$city] , $this->param);
    }

    public function create()
    {
        $this->param['subtitle'] = 'Add new City';
        return view('master.city.create', $this->param);
    }

    public function store(Request $req)
    {
        $validatedData = $req->validate([
            'city' => 'required|unique:city,name',
        ],
        [
            'unique' => 'this city is already registered.'
        ]);

        try{
            $city = $req->get('city');
            $newCity = new City;

            $newCity->name = $city;
            $newCity->save();

            alert()->success('Successfully added data', 'Success')->autoclose(2000);

            return redirect('master/city');
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
            $this->param['subtitle'] = 'Change your current city';
            $this->param['city'] = City::findOrFail($id);
        
            return view('master.city.edit', $this->param);
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
        $this->validate($req,[
            'city' => 'required|unique:city,name'
        ]);
        
        try{
            $updateCity = City::findOrFail($id);
            if(!is_null($req->get('city'))){
                $updateCity->name = $req->get('city');
                $updateCity->save();
            }

            alert()->success('Successfully updated data', 'Success')->autoclose(2000);
            return redirect('master/city');
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
            $deleteCity = City::findOrFail($id);

            $deleteCity->delete();

            alert()->success('Successfully deleted data', 'Success')->autoclose(2000);

            return redirect('master/city');
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
}
