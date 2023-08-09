<?php
  $status = "";
  if(isset($_POST['submit'])){
    $city = $_POST['city'];
    $url ="https://api.openweathermap.org/data/2.5/forecast?q=$city&appid=a82f1c3aa55b0b86c03fddf7b9e8db96";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result,true);
    $status = "yes";
  }
 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    
    <div class="container">
        <div class="location-container">
            <form  action="" method="post">
                 <input type="text" class="location-search" placeholder="Enter city Name" name="city">
                <input type="submit" class="location-button" value="Submit" name="submit">
            </form>
        </div>
        <?php if($status=="yes"){ ?>
        <div class="weather-side">
            <div class="weather-gradient">
            </div>

            <div class="date-container">
                <h2 class="date-dayname"><?php echo date('l',$result['list'][0]['dt']) ?></h2>
                <span class="date-day"><?php echo date('d M y',$result['list'][0]['dt']) ?></span>
                <span class="date-day"><?php echo date('h:i A',$result['list'][0]['dt']) ?></span>
                <i class="location-icon fa-solid fa-location-dot"></i>
                <span class="location"><?php echo $result['city']['name'] ?></span>
            </div>

            <div class="weather-container">
                <img src="https://openweathermap.org/img/wn/<?php echo $result['list'][0]['weather'][0]['icon'] ?>@2x.png" class="weather-icon">
                <h1 class="weather-temp"><?php echo round($result['list'][0]['main']['temp']-273.15) ?>°C</h1>
                <h3 class="weather-desc"><?php echo $result['list'][0]['weather'][0]['description'] ?></h3>
            </div>

        </div>

        <div class="info-side">
            <div class="today-info-container">

                <div class="today-info">

                    <div class="wind">
                        <span class="title">Feel's Like</span>
                        <span class="value"><?php echo round($result['list'][0]['main']['feels_like']-273.15) ?>°C</span>
                        <div class="clear"></div>
                    </div>

                    <div class="precipitation">
                        <span class="title">PRECIPITATION</span>
                        <span class="value"><?php echo $result['list'][0]['pop']*100 ?> %</span>
                        <div class="clear"></div>
                    </div>

                    <div class="humidity">
                        <span class="title">HUMIDITY</span>
                        <span class="value"><?php echo $result['list'][0]['main']['humidity'] ?> %</span>
                        <div class="clear"></div>
                    </div>

                    <div class="wind">
                        <span class="title">WIND</span>
                        <span class="value"><?php echo ($result['list'][0]['wind']['speed']*3600)/1000 ?> km/h</span>
                        <div class="clear"></div>
                    </div>
                    


                </div>

                <div class="week-container">

                    <ul class="week-list">

                        <li>
                            <img src="https://openweathermap.org/img/wn/<?php echo $result['list'][8]['weather'][0]['icon'] ?>@2x.png" class="day-icon">
                            <span class="day-name"><?php echo date('D',$result['list'][8]['dt']) ?></span>
                            <span class="day-temp"><?php echo round($result['list'][8]['main']['temp']-273.15) ?>°C</span>
                            <span class="day-name">HUMIDITY</span>
                            <span class="day-temp"><?php echo $result['list'][8]['main']['humidity'] ?> %</span>
                        </li>

                        <li>
                        <img src="https://openweathermap.org/img/wn/<?php echo $result['list'][16]['weather'][0]['icon'] ?>@2x.png" class="day-icon">
                            <span class="day-name"><?php echo date('D',$result['list'][16]['dt']) ?></span>
                            <span class="day-temp"><?php echo round($result['list'][16]['main']['temp']-273.15) ?>°C</span>
                            <span class="day-name">HUMIDITY</span>
                            <span class="day-temp"><?php echo $result['list'][16]['main']['humidity'] ?> %</span>
                        </li>

                        <li>
                            <img src="https://openweathermap.org/img/wn/<?php echo $result['list'][24]['weather'][0]['icon'] ?>@2x.png" class="day-icon">
                            <span class="day-name"><?php echo date('D',$result['list'][24]['dt']) ?></span>
                            <span class="day-temp"><?php echo round($result['list'][24]['main']['temp']-273.15) ?>°C</span>
                            <span class="day-name">HUMIDITY</span>
                            <span class="day-temp"><?php echo $result['list'][24]['main']['humidity'] ?> %</span>
                        </li>

                        <li>
                            <img src="https://openweathermap.org/img/wn/<?php echo $result['list'][32]['weather'][0]['icon'] ?>@2x.png" class="day-icon">
                            <span class="day-name"><?php echo date('D',$result['list'][32]['dt']) ?></span>
                            <span class="day-temp"><?php echo round($result['list'][32]['main']['temp']-273.15) ?>°C</span>
                            <span class="day-name">HUMIDITY</span>
                            <span class="day-temp"><?php echo $result['list'][32]['main']['humidity'] ?> %</span>
                        </li>
                        <div class="clear"></div>

                    </ul>

                </div>

                
        
            </div>
        </div>
        <?php } ?>
    </div>


</body>

</html>