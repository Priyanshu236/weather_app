<?php
$weather="";
$error="";
$ini=0;
if(isset($_GET['city'])){
    $ini=1;
    $url=str_replace(' ','',$_GET['city']);
    $file_headers = @get_headers('https://www.weather-forecast.com/locations/'.$url.'/forecasts/latest');
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error="City could not be found";
    }
    else {
    
    $forecast=file_get_contents("https://www.weather-forecast.com/locations/".$url."/forecasts/latest");
    $pageArr=explode('</h2> (1&ndash;3 days):</div><p class="location-summary__text"><span class="phrase">',$forecast);
    $exp='</span></p></div><div class="location-summary__item location-summary__item--js is-truncated"><div class="location-summary__heading-with-ext"><h2 class="location-summary__heading">';
    $secondArr=explode($exp,$pageArr[1]);
    $weather=$secondArr[0];
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        html {

            background: url("bg_img.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }

        body {
            color: white;
            background: none;
        }

        .container {
            text-align: center;
            margin-top: 150px;
            width: 400px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>What's the weather?</h1>
        

        <form >
            <div class="form-group">
                <label  for="city">Enter the name of City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Eg. Mumbai Delhi" value="<?php if(isset($_GET['city'])){echo $_GET['city'];}else if($ini){echo "Bad city name";} ?>">
                <button style="margin: 3px;" type="submit" class="btn btn-primary">Submit</button>
                <div id="weather">
                    <?php 
                    if($weather){
                        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                    }else if($error){
                        echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                    }
                    ?>
                </div>
            </div>
            

            
            
        </form>
    </div>

</body>

</html>