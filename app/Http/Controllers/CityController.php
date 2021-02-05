<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $title = 'City';

    public function index()
    {
        $city = City::select('id', 'name')->orderBy('name', 'ASC')->paginate(5);
        return view('master.city.index',['city'=>$city] , ['title'=>$this->title]);
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
