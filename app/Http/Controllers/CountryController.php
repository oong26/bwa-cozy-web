<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Country';
    }

    public function index(Request $req)
    {
        try{
            if(!is_null($req->get('s'))){
                $this->param['country'] = Country::select('id', 'name')->where('name', 'LIKE' ,'%'.$req->get('s').'%')->orderBy('name', 'ASC')->paginate(5);
            }
            else{
                $this->param['country'] = Country::select('id', 'name')->orderBy('name', 'ASC')->paginate(5);
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
        return view('master.country.index', $this->param);
    }

    public function create()
    {
        $this->param['subtitle'] = 'Add new Country';
        return view('master.country.create', $this->param);
    }

    public function store(Request $req)
    {
        $validatedData = $req->validate([
            'country' => 'required|unique:country,name',
        ],
        [
            'unique' => 'this country is already registered.'
        ]);

        try{
            $country = $req->get('country');
            $newCountry = new Country;

            $newCountry->name = $country;
            $newCountry->save();

            alert()->success('Successfully added data', 'Success')->autoclose(2000);

            return redirect('master/country');
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
            $this->param['subtitle'] = 'Change your current country';
            $this->param['country'] = Country::findOrFail($id);
        
            return view('master.country.edit', $this->param);
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
            'country' => 'required|unique:country,name'
        ]);
        
        try{
            $updateCountry = Country::findOrFail($id);
            if(!is_null($req->get('country'))){
                $updateCountry->name = $req->get('country');
                $updateCountry->save();
            }

            alert()->success('Successfully updated data', 'Success')->autoclose(2000);
            return redirect('master/country');
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
            $deleteCountry = Country::findOrFail($id);

            $deleteCountry->delete();

            alert()->success('Successfully deleted data', 'Success')->autoclose(2000);

            return redirect('master/country');
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
