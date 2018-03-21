<?php
define('BASEPATH',__DIR__);
include('application/config/database.php');
ini_set('memory_limit','2048M');
if (ob_get_level() == 0) ob_start();
@ini_set('zlib.output_compression',0);
@ini_set('implicit_flush',1);
@ob_end_clean();
set_time_limit(0);

$con=mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']);
mysql_select_db($db['default']['database']);

$csvPages = csv_to_array('sitelinks.csv');


if($csvPages){
  $ctr = 1;
  echo "<table width=100% border=1 >";
  echo "<tr><thead>";
  echo "<th>Ctr</th>";
  echo "<th>Title</th>";
  echo "<th>Slug</th>";
  echo "<th>SQL QUERY</th>";
  echo "<th>Status</th>";
  echo "</thead></tr>";

  foreach ($csvPages as $pages) {
    $pagesSlug = trim($pages['slug']);
    $slugsList[$pagesSlug] = $pages;

  }

  //echo "<pre>";
  //print_r($slugsList );
  //echo "</pre>";
  //exit();



  $sql = "SELECT title,slug,content FROM pages";
  $result = @mysql_query($sql);


  while ($row = mysql_fetch_assoc($result)) {

    $pages_title = $row['title'];
    $pages_slug = strtolower($row['slug']);
    $pages_content = $row['content'];


    
    echo "<tr>";
    echo "<td>{$ctr}</td>";
    echo "<td>{$pages_title}</td>";
    echo "<td>{$pages_slug}</td>";

    //echo $slugsList[$pagesSlug]['content'];
    //exit();

    if(array_key_exists($pages_slug, $slugsList)){
     
      //if( $pages_content != $slugsList[$pages_slug]['content']){
        $content = mysql_real_escape_string($slugsList[$pages_slug]['content']);
        $title = mysql_real_escape_string($slugsList[$pages_slug]['title']);
        $queryUpdateContent = "UPDATE pages SET content = '{$content}', title = '{$title}' WHERE `slug`='{$pages_slug}' ";
        $updateContentResult = @mysql_query($queryUpdateContent);
        if($updateContentResult == 1){
          $updateContentResult  = "Page Successfully Updated!";
          $style = "";
        }else{
          $style = "";
        }
      //}else{
        //$updateContentResult = null;
        //$queryUpdateContent = 'No Need To Update: Same Content';
        //$style = "";
      //}
      

    } else {


      $updateContentResult = null;
      $queryUpdateContent = 'Slug does not exists or the page is not on csv';
      $style = "background: #BD1717; color: #FFF";
      


    }

    echo "<td style='$style'>$queryUpdateContent</td>";
    echo "<td>$updateContentResult</td>";

    //exit();

    $ctr++;
  }
  


  echo "</table>";



  


}


echo "-end of records-<br>";
echo "-UpdatePagesContent-";
// mysql_close($con);


//Global Functions
function csv_to_array($filename='', $delimiter=',')
{
  if(!file_exists($filename) || !is_readable($filename))
    return FALSE;

  $header = NULL;
  $data = array();
  if (($handle = fopen($filename, 'r')) !== FALSE)
  {
    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
    {
      if(!$header)
        $header = $row;
      else
        $data[] = array_combine($header, $row);
    }
    fclose($handle);
  }
  return $data;
}


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


function cityStKey($pages, $st){
  return normalizeString($pages.", ".$st);
}

function normalizeString($var){
  $var = rtrim($var);
  $var = ltrim($var);
  $var = strtolower(trim($var));
  return $var;
}