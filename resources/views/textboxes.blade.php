<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <style>
        .container
        {
          margin-top: 100px;
        }
        .ScrollStyle
{
    max-height: 150px;
    width: 200px;
    overflow-y: scroll;
}
    </style>
  </head>

<div class="h-100 d-flex justify-content-center align-items-center">
    <div class="countries">
        <label>Country</label>
        <input type="text" class="typeahead form-control" id="country">
    </div>
    <div class="cities">
        <label>City</label>
        <input type="text" class="typeahead form-control" id="city">
        <!-- <datalist id="cityList"></select> -->
        
    </div>
</div>


<script>
  //To get the current value of city
  function getCityVal(){
    return $("#city").val();
  }

  //To get the current value of country
  function getCountryVal(){
    return $("#country").val();
  }

  //bloodhound instance for country textbox
  var country = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
 
    
    remote : {
        url : '/dummy/countrySearch',
        prepare : function(query,settings){
            settings.data = {country: query , city : getCityVal()};  
            return settings;        
        },
      
    
    }
  });

      //typeahead for countries
    $('.countries .typeahead').typeahead({
      hint : true,
      highlight: true,
      minLength : 1
    },{
    
      name: 'countries',
      display:'country',
    
      source: country
    });


    //city bloodhound instance
    var cities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        
        url: '/dummy/citySearch',
        prepare: function(query, settings){
          
          settings.data = {city: query , country : getCountryVal()};
          return settings;
        }
    },

    });
    $('.cities .typeahead').typeahead( { 
      hint : true,
      highlight: true,

      minLength : 1}
      ,{ 
      

      name: 'cities',
     
      display : 'city',
      source: cities,
      

    });
  
    //adding scroll bar to menu
    $('.tt-menu').addClass('ScrollStyle');
    
    function countryListener(){
      setTimeout(function() {
        
     
        if(getCityVal() == ""){
          $.ajax({
          type : "GET",
          data :{'country' : getCountryVal()},
          url : 'dummy/city',
          success: function(data){
            
            autoCity(data);
          },
        });
        }
      }, 500);
    }
    
    //click event on selecting country

     $(".tt-dataset-countries").click(function(){
        countryListener();
     
       
    });

    $("#country").keyup(function (event){
      
      if(event.keyCode == 13){
        countryListener();
      }
    });
    
  

  

    //for auto citytext box
    function autoCity(data){
      
      $("#city").empty();
     
      
      for(let i=0; i<data.length ; i++){
        city =  data[i]['city'];
       
        
        $('.tt-dataset-cities').append('<div class="tt-suggestion tt-selectable" >'+city+'</div>');
    
      }
      //$('.tt-menu').removeClass("tt-empty");
      $('#city').focus();
    }
  
    function cityListener(){
      setTimeout(function() {
        
      
        if(getCountryVal() == ""){
          $.ajax({
          type : "GET",
          data :{'city' : getCityVal()},
          url : 'dummy/country',
          success: function(data){
            
            autoCountry(data);
          },
        })
        }
      }, 500);
    }
    
    //auto select for city click

    $(".tt-dataset-cities").click(function(){
     
      countryListener();
     
    
    })

    //auto select for city enter
    $("#city").keyup(function (event){
      
      if(event.keyCode == 13){
        cityListener();
      }
    });


    //for auto countrytext box
    function autoCountry(data){
      
      $("#country").empty();
      
      for(let i=0; i<data.length ; i++){
        country =  data[i]['country'];
        
        
        $('.tt-dataset-countries').append('<div class="tt-suggestion tt-selectable">'+country+'</div>');
      }
   
      $('#country').focus();
    }

</script>
   
