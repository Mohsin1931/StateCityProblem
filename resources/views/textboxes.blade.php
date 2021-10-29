<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <style>
        .container
        {
          margin-top: 100px;
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
        // transform: function(data){
        //   //console.log(data);
        //     autoCity(data);
        //     return data;
        // }
     

      
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
    // hint: true,
      display : 'city',
      source: cities,
      

    });

    $(".tt-dataset-countries").click(function(){
      setTimeout(function() {
        
     
      if(getCityVal() == ""){
        $.ajax({
        type : "GET",
        data :{'country' : getCountryVal()},
        url : 'dummy/city',
        success: function(data){
          console.log("Asdsad");
          autoCity(data);
        },
      });
      }
    }, 300);
    
    });

    //for auto citytext box
    function autoCity(data){
      
      $("#city").empty();
     
      
      for(let i=0; i<data.length ; i++){
        city =  data[i]['city'];
       
        
        $('.tt-dataset-cities').append('<div class="tt-suggestion tt-selectable">'+city+'</div>');
        if(i==5){
          break;
        }
      }
   
      $('#city').focus();
    }

    
    //auto select for country

    $(".tt-dataset-cities").click(function(){
      console.log("////////////");
      console.log(getCityVal());
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
    }, 300);
    
    })

    //for auto countrytext box
    function autoCountry(data){
      
      $("#country").empty();
      
      for(let i=0; i<data.length ; i++){
        country =  data[i]['country'];
        
        
        $('.tt-dataset-countries').append('<div class="tt-suggestion tt-selectable">'+country+'</div>');
        if(i == 5){
          break;
        }
      }
   
      $('#country').focus();
    }

</script>
   
