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
            $countries = DB::select("SELECT  country FROM cityCountries WHERE city LIKE '$rec_city' And country LIKE '%$rec_country%' Limit 50");
        }
        else{
            $countries = DB::select("SELECT country FROM cityCountries WHERE country LIKE '%$rec_country%' Limit 50");
        }
        
       
        return $countries;

    }

    public function citySearch(Request $request){
        $rec_country = $request->country;
        $rec_cities = $request->city;
        
        if(!empty($rec_country)){
            $cities = DB::select("SELECT  city FROM cityCountries WHERE country LIKE '$rec_country' And city LIKE '%$rec_cities%' Limit 50");
        }
        else{
            $cities = DB::select("SELECT  city FROM cityCountries WHERE city LIKE '%$rec_cities%' Limit 50");
        }

        
      
        return $cities;

    }

    public function city(Request $request){
        $data = $request->all();
        $country = $data['country'];
       $cities = DB::select("SELECT city FROM cityCountries WHERE country LIKE '$country' Limit 50");
        return $cities;
    }

    public function country(Request $request){
        $data = $request->all();
        $city = $data['city'];
       $countries = DB::select("SELECT country FROM cityCountries WHERE city LIKE '$city' Limit 50");
        return $countries;
    }



 
}
