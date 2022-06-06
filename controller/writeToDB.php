<?php
require_once 'connect.php';
$file = fopen('write2DB.txt','r');

while (!feof($file)) 
{
	$getTextLine = fgets($file);
	$explodeLine = explode(",",$getTextLine);
	list($user_id,$title,$eventType,$description,$doe,$date_updated,$slug) = $explodeLine;
	
	$query = "Insert into eventPost (user_id, title, eventType, eventDescription, doe, date_updated, slug) values('$user_id','$title','$eventType','$description','$doe','$date_updated','$slug')";
	if(mysqli_query($connection,$query)){
        echo "\ninserted successfully.";
    }
}
fclose($file);
?>