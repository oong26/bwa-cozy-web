<?php

namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\City;
use App\Models\Country;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BoardingHouseController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Boarding House';
    }
    
    public function index(Request $req)
    {
        try{
            if(!is_null($req->get('s'))){
                $this->param['boarding_house'] = BoardingHouse::select(
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
                ->where('boarding_house.name', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('city.name', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('country.name', 'LIKE', '%'.$req->get('s').'%')
                ->orWhere('boarding_house.address', 'LIKE', '%'.$req->get('s').'%')
                ->orderBy('boarding_house.name', 'ASC')
                ->paginate(5);
                
                return view('master.boarding-house.index', $this->param);
            }
            else{
                $this->param['boarding_house'] = BoardingHouse::select(
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
                
                return view('master.boarding-house.index', $this->param);
            }
        }
        catch(Exception $e){
            alert()->error($e->getMessage(), 'Error');
            return redirect()->back();
        }
        catch(QueryException $e){
            alert()->error($e->getMessage(), 'Database Error');
            return redirect()->back();
        }
    }

    public function create()
    {
        $this->param['subtitle'] = 'Add new Boarding House';
        $this->param['country'] = Country::all();
        $this->param['city'] = City::all();
        return view('master.boarding-house.create', $this->param);
    }

    public function edit($id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
