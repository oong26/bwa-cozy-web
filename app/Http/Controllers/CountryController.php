<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $title = 'Country';

    public function index()
    {
        $country = Country::select('id', 'name')->orderBy('name', 'ASC')->paginate(5);
        return view('master.country.index',['country'=>$country] , ['title'=>$this->title]);
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
