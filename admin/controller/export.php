<?php  
 require_once 'connect.php';

 if(isset($_GET["export_id"]))  
 {  
     $id = $_GET["export_id"];
     if($id == 1){
         $query = "SELECT * from user";  
         $filename = "userDB.csv";
    }else if($id==2){
        $query = "SELECT * from eventpost"; 
        $filename = "eventDB.csv"; 
    }else if($id==3){
        $query = "SELECT * from service";  
        $filename = "serviceDB.csv"; 
    }else if($id==4){
        $query = "SELECT * from rental";  
        $filename = "renatalDB.csv"; 
    }else{
        echo "bad request";
        exit();
    }

    header('Content-Type: text/csv; charset=utf-8');  
    header("Content-Disposition: attachment; filename=".basename($filename)."");  
    $output = fopen("php://output", "w");  
    $result = mysqli_query($connection, $query);  
    while($row = mysqli_fetch_assoc($result))  
    {  
         fputcsv($output, $row);  
    }  
    fclose($output);
    header("../html/dashboard.php");
 }  

 

 if(isset($_POST["eventtxt"]))  
 {  
    $fh = fopen('data.txt', 'w');

    $result = mysqli_query($connect, "SELECT * FROM eventPost;");   
    while ($row = mysqli_fetch_array($result)) {          
        $last = end($row);          
        $num = mysqli_num_fields($result);
        for($i = 0; $i < $num; $i++) {            
            fwrite($fh, $row[$i]);                      
            if ($row[$i] != $last)
               fwrite($fh, ", ");
        }                                                                 
        fwrite($fh, "\n");

    }
    fclose($fh);
    
 }
 ?>