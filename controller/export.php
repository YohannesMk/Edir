<?php  

 $connect = mysqli_connect("localhost", "root", "", "edir");  
if(isset($_GET['slug'])){
    $slug = $_GET['slug'];
}
 if(isset($_POST["eventcsv"]))  
 {  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=userDB.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('user_id', 'Title', 'Event Type', 'EventDescription','DOE','date_updated', 'slug'));  
      $query = "SELECT * from eventPost";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
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