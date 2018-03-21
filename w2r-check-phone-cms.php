<?php
define('BASEPATH',__DIR__);
include('application/config/database.php');
ini_set('memory_limit','512M');
if (ob_get_level() == 0) ob_start();

$con=mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']);
mysql_select_db($db['default']['database']);

if ( !isset($_GET['phonenumber']) OR empty($_GET['phonenumber']) )  {
  echo "<h2>Phone number is not set</h2>";
  echo "<h3>ex: http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "?phonenumber=(888) 888-8888</h3>";
  exit;
} else {
  $phonenumber = $_GET['phonenumber'];
}

//get all cities
$cities = mysql_query("SELECT name,state,description,area_code,slug,phone FROM cities");

$stateRes = mysql_query("SELECT * FROM states");
$statesList = mysql_fetch_array($stateRes);

//echo "statelist" ; debug($statesList);

echo "<table border=1 width=100%>";
echo "<tr>";
echo "<td>URL</td>";
echo "<td>City</td>";
echo "<td>State</td>";
echo "<td>Phone</td>";
echo "<td>Remarks</td>";
echo "</td>";
$ctrNotOk = 0;
$citiesNotOk = array();
while ($row = mysql_fetch_array($cities)) {

  $link = $_SERVER['SERVER_NAME'].'/'.$row['slug'];
  $phone = $row['phone'];
  $description = $row['description'];

  if ($phonenumber != $phone) {
    $style = "background: red; color: white;";
    $remarks = "NOT OK!";
    array_push($citiesNotOk, $row['slug']);
    $ctrNotOk++;
  } else{
    $style = "background: white";
    $remarks = "OK!";
  }

  echo "<tr  style='{$style}'>";
  echo "<td><a href='http://".$link."' style='{$style}'> {$link} </a> </td>";
  echo "<td>{$row['name']}</td>";
  echo "<td>".strtoupper($row['state'])."</td>";
  echo "<td>{$phone}</td>";
  echo "<td>{$remarks}</td>";
  echo "</tr>";
  ini_set('max_execution_time', 0);
  ob_flush();
  flush();
}

echo "</table>";


echo "-end of records-<br><br>";
//echo "-hakunamatata-<br>";

$citiesNotOk = implode(",", $citiesNotOk);


echo "<span style='color: red; font-weight: bold;'>NUMBER OF CITIES WITH DIFFERENT PHONE NUMBER: ".$ctrNotOk."</span><br> (".$citiesNotOk.")<br>";

function debug($var,$name=null,$file=null,$line=null){

  echo "<div  style='margin: 10px; background: #FCFCFC; padding: 10px;'>";
  if(isset($name)){echo "<div style='padding-bottom: 10px; font-weight: bold; border-bottom: 1px solid #DDD'>".$name."</div>"; }
  if(isset($var)){
    echo "<pre>"; 
    print_r($var);
    echo '</pre>';
  }else{
    echo 'Not Set';
  }
  echo "</div>";
}