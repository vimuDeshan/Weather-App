<html>
<head>
<style>
#weather {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#weather td, #weather th {
  border: 1px solid #ddd;
  padding: 8px;
}

#weather tr:nth-child(even){background-color: #f2f2f2;}

#weather tr:hover {background-color: #ddd;}

#weather th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
<?php
$apiKey = '78f6a73af3f8db4b73e8edb4bcb9242b';

$file = file_get_contents("input.json");
$json = json_decode($file, true);

$city = [];
foreach ($json['List'] as $key => $val) {
	array_push($city, $val['CityCode']);
}
//echo implode(',', $city);
$data = file_get_contents('https://api.openweathermap.org/data/2.5/group?id='.implode(',', $city).'&units=metric&appid='.$apiKey);
//echo $data;
$d = json_decode($data, true);

$columns = ["CityCode", "CityName", "Temp", "Status"];

echo '<table id="weather"><thead><tr>';

foreach($columns as $column) {
    echo '<th>'.$column.'</th>';
}

echo '</tr></thead><tbody>';

foreach ($d['list'] as $k => $v) {
    echo '<tr>';
    echo '<td>'.$v['id'].'</td>';
    echo '<td>'.$v['name'].'</td>';
    echo '<td>'.$v['main']['temp'].'</td>';
    echo '<td>'.$v['weather'][0]['description'].'</td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>
</body>
</html>
