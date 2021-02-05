<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    private $title = 'Boarding House';
    
    public function index()
    {
        $boarding_house = BoardingHouse::select(
                                        'boarding_house.id',
                                        'boarding_house.name AS house_name',
                                        'boarding_house.id_city',
                                        'boarding_house.id_country',
                                        'boarding_house.address',
                                        'boarding_house.price',
                                        'city.id',
                                        'city.name AS city_name',
                                        'country.id',
                                        'country.name AS country_name'  
                                    )
                                    ->join('city', 'city.id', 'boarding_house.id_city')
                                    ->join('country', 'country.id', 'boarding_house.id_country')
                                    ->orderBy('house_name', 'ASC')
                                    ->paginate(5);
                                    
        return view('master.boarding-house.index',['boarding_house'=>$boarding_house] , ['title'=>$this->title]);
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
