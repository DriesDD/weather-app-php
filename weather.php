<html>
 <head>
  <title>What's the weather?</title>
  <style>
div.weather {
  text-align: center;
}
</style>
 </head>
 <body>

<div class='weather'>
<form action="weather.php" method="post">
Dries, what's the weather like in
<input type="text" name="city" placeholder="Enter city" />
?
<input type="submit" name="submit"/>
</form>
<br>
<?php
$city = $_REQUEST['city'];
if (is_string($city) == true && strlen($city) > 1)
{
$url = 'https://api.openweathermap.org/data/2.5/forecast?q=';
$url.= $city;
$url.='&mode=xmly&appid=48a8b4741cc8cb086ca2bbffc8c983cb';
$data = json_decode(file_get_contents($url),1);
$datacityname = $data['city']['name'];
$dayCounter = 0;
echo $datacityname;
echo "?<br>";
$datacurrent = ucfirst($data['list']['0']['weather']['0']['description']);
echo ($datacurrent);
echo ' and ';
echo ($data['list']['0']['main']['temp'] - 273.15);
echo ' °C. <br>';
echo " <br>The next three hours we have ";
$ts = $data['list'][0]['dt'];
$dt = date_create("@$ts");
$dayStore =  date_format($dt, 'd');
for ($i=1; $i<40; $i++) {
 if ($j != $data['list'][$i]['weather']['0']['main'])
 {  if ($repeat > 0)
  {echo strtolower($data['list'][$i]['weather']['0']['main']);
   echo " for $repeat hours ";
  }
  else
  {
    echo ($data['list'][$i]['weather']['0']['description']);
  }
  $ts = $data['list'][$i]['dt'];
  $dt = date_create("@$ts");
  if (date_format($dt, 'd') == $dayStore) {
  echo ", then ";
  }
  else 
  {if ($dayCounter == 0) {
  echo ". Tomorrow ";
  }
  else if ($dayCounter == 1) {
  echo ". <br> However, overtomorrow";
  }
  else {
  echo ". The day after";
  }
  if (date_format($dt, 'H') < 12)
  {echo " starts out with ";
  }
  else {
   echo ", after all of that, we'll have ";
  }
  $dayCounter += (date_format($dt, 'd') - $dayStore);
  }
  $dayStore =  date_format($dt, 'd');
  $repeat = 0;
}
 else
  {$repeat += 3;
  }
 $j = $data['list'][$i]['weather']['0']['main'];
}
echo " I don't know anymore.";
var_dump($dt);

var_dump($data['list'][0]);
}

?>
</div>
 </body>
</html>