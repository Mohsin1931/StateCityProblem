<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <style>
        #cities
        {
          margin-top: 100px;
        }
    </style>
  </head>
<div id="states">
  <label>State</label>
  <input class="typeahead" id="statesID" type="text" placeholder="States of USA">
</div>

<div id="cities">
  <label>City</label>
  <input  class="typeahead" id="citiesID" type="text" placeholder="Cities in USA States">
</div>

<script>



//To get the current value of city
  function getCityVal(){
    return $("#citiesID").val();
  }

 // constructs the suggestion engine
var states = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
 
    //  local: states
    remote : {
        url : '/dummy/stateBeginsWith',
        prepare : function(query,settings){
            settings.data = {state: query , city : getCityVal()};  
            return settings;        
        },
    }
});

//typeahead
$('#states .typeahead').typeahead({
  hint : true,
  highlight: true,
  minLength : 1
},{
 
  name: 'states',
  source: states
});

//to get value of city field
function getStateVal(){
     return $("#statesID").val();
    //return "California"; 
}
var cities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        
        url: '/dummy/beginsWith',
        prepare: function(query, settings){
          
          settings.data = {city: query , state : getStateVal()};
          return settings;
        }
    },

});
$('#cities .typeahead').typeahead( { 
  hint : true,
  highlight: true,
  minLength : 1}
   ,{ 
  

  name: 'cities',
 // hint: true,
  source: cities,
  

});

</script>