<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyController extends Controller
{
    //To handle city search engine requests
    public function beginsWith(Request $request)
    {
       
        $rec_state = $request->state;
        $rec_cities = $request->city;
        
        
        $citiesStatesArray = array(
            "Alabama" => ['Alexander City', 'Andalusia' ,'Anniston', 'Athens', 'Atmore', 'Auburn', 'Bessemer', 'Birmingham'], 
            "California" => ['Adelanto', 'Agoura Hills','Alameda' ,'Baker' ,'Bakersfield' ,'Balboa Island' ,'Calabasas', 'Calexico', 'California City' ],
            "Florida" => [  'Alachua','Altamonte Springs','Bal Harbour','Bartow','Cape Coral','Casselberry','Dania Beach','Davie','Edgewater','Edgewood'],
            "Kansas" => ['Kansas City','Lawrence','Olathe','Overland Park','Topeka','Wichita','Manhattan','Lenexa','Alexander City','Adelanto'],
            "Washington" => ['Kansas City','Lawrence' ,'Alachua','Altamonte Springs','Adelanto', 'Agoura Hills' ,'Alexander City', 'Andalusia' ,'Anniston'],
        
        );
        $citiesArray = array(
            'Alexander City', 'Andalusia' ,'Anniston','Baker' ,'Bakersfield' ,'Balboa Island' ,'Calabasas','Kansas City','Lawrence','Olathe','Overland Park','Topeka','Overland Park','Topeka','Wichita','Manhattan',
        );
        if(!empty($rec_state)){
            $citiesInStates = $citiesStatesArray[$rec_state];
            return $citiesInStates;
        }
        
       
        return $citiesArray;
    }

    //To handle state search engine requests
    public function stateBeginsWith(Request $request){
        $rec_state = $request->state;
        $rec_city = $request->city;
        $states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
            'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
            'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
            'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
            'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ];
        $citiesArray = array(
            "Alabama" => ['Alexander City', 'Andalusia' ,'Anniston', 'Athens', 'Atmore', 'Auburn', 'Bessemer', 'Birmingham'], 
            "California" => ['Adelanto', 'Agoura Hills','Alameda' ,'Baker' ,'Bakersfield' ,'Balboa Island' ,'Calabasas', 'Calexico', 'California City' ],
            "Florida" => [  'Alachua','Altamonte Springs','Bal Harbour','Bartow','Cape Coral','Casselberry','Dania Beach','Davie','Edgewater','Edgewood'],
            "Kansas" => ['Kansas City','Lawrence','Olathe','Overland Park','Topeka','Wichita','Manhattan','Lenexa','Alexander City','Adelanto'],
            "Washington" => ['Kansas City','Lawrence' ,'Alachua','Altamonte Springs','Adelanto', 'Agoura Hills' ,'Alexander City', 'Andalusia' ,'Anniston'],
        
        );
        $results = [];
        $count = 0;
        $j=0;
        if(!empty($rec_city))
        {
            foreach($citiesArray as $city){
                for($i=0 ; $i < sizeof($city)-1 ; $i++ ){
                    if($city[$i] == $rec_city)
                    {
                        $results[$count] = array_keys($citiesArray)[$j];
                        $count++;
                    }
                }
               $j++;
            }

            return $results;
        }
        return $states;
    }

 
}
