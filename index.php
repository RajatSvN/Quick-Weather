
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
       <title>Weather Scraper</title>
  </head>
  <style type="text/css">
.container{
margin-top : 275px ; 
}
body { 
  background: url(Weather.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
    
  
  </style>
  <body >
 <div class="container mx-auto">
 
 <h2 class="text-center" >What's the Weather?</h2>
    <p class="text-center">Enter the name of city.</p>
	<form method="get">
  <div class="form-group">
 
    <input type="text" class="form-control col-sm-4 mx-auto my-4" id="TextEntry" aria-describedby="emailHelp" placeholder="Eg. London Tokyo" name="city">
 
 <center><button type="submit" class="btn btn-primary my-2" id="butn">Submit</button></center> 
    </form>

 </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  </body>
</html>
  <?php
$weather = "";
$error = "";

	if($_GET['city']){
      $urlcontents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city'].",ind&appid=75d37###################d");
      
      $weatherArray = json_decode($urlcontents,true);
     
      if($weatherArray['cod']==200){
      $weather = "The weather conditions in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";
      $temp = $weatherArray['main']['temp'] - 273;
      $temperature = "The temperature is : ".floor($temp)."&deg;C";
      $windSp = $weatherArray['wind']['speed'] * (18 / 5) ;
      $windDesc = "The wind speed is : ".floor($windSp)." kmph ." ;
       $weather = $weather."<br>".$temperature."<br>".$windDesc ;
        echo  "<div class='alert alert-success'  style='text-align : center'>".$weather."</div>" ;
       
      }else{
      
      $error = "The city name entered is either invalid or try other popular
      names for the city , eg. Bombay for Mumbai.";
       echo  "<div class='alert alert-danger' style='text-align : center'>".$error."</div>" ;
      
      }
    }
  // On Refresh go to Original State
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 
if($pageRefreshed == 1){
   echo '<script>window.location="http://rajhosting-com.stackstaging.com/WeatherAPI/index.php"</script>';
}




?>