<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dummyController extends Controller
{


    public function countrySearch(Request $request){
        $rec_country = $request->country;
        $rec_city = $request->city;

        if(!empty($rec_city)){
            $countries = DB::select("SELECT country FROM cityCountries WHERE city LIKE '$rec_city' And country LIKE '$rec_country%'");
        }
        else{
            $countries = DB::select("SELECT country,city FROM cityCountries WHERE country LIKE '$rec_country%'");
        }
        
       
        return $countries;

    }

    public function citySearch(Request $request){
        $rec_country = $request->country;
        $rec_cities = $request->city;
        
        if(!empty($rec_country)){
            $cities = DB::select("SELECT city FROM cityCountries WHERE country LIKE '$rec_country' And city LIKE '$rec_cities%'");
        }
        else{
            $cities = DB::select("SELECT city FROM cityCountries WHERE city LIKE '$rec_cities%'");
        }

        
      
        return $cities;

    }

    public function city(Request $request){
        $data = $request->all();
        $country = $data['country'];
       $cities = DB::select("SELECT city FROM cityCountries WHERE country LIKE '$country'");
        return $cities;
    }

    public function country(Request $request){
        $data = $request->all();
        $city = $data['city'];
       $countries = DB::select("SELECT country FROM cityCountries WHERE city LIKE '$city'");
        return $countries;
    }



 
}
