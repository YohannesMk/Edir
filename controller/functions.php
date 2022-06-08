<?php
function create_slug($string){
    $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string.'-'.date("Y/m/d"));
    return $slug;
 }

function query_result_count($connection, $search, $string){
    if(!empty($search)){
        $sql = "SELECT COUNT(*) FROM timeline WHERE category = '$string' AND title like '%$search%'";
    }else{
        $sql = "SELECT COUNT(*) FROM timeline WHERE category = '$string'";
    }
    $result = mysqli_query($connection,$sql);
    if($result != null){

        $total_rows = mysqli_fetch_array($result)[0];
        
    }else{
        $total_rows = 0;
    }

    return $total_rows;
}

function updateCart($connection, $subtotal_query, $user_id){
    $sub_result = mysqli_query($connection, $subtotal_query);
    $subtotal_price = 0;
    
    while($cart_rows = mysqli_fetch_array($sub_result)){
        $return = relateService($connection, $cart_rows);
        $days = 6;
        $subtotal_price += (double)$return['price'] * (double)$cart_rows['quantity']* $days;
    }
}


function exportImage($filename){
    if(file_exists($filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' .filesize($filename));
        header('Pragma: public');
        
        flush();
        readfile($filename);
        die();
        }
        else{
            echo "File does not exist.";
        }
}

function relateService($connection, $rows){
    $id = $rows['item_id'];
    $query = "SELECT * From Service where item_id = '$id'";
    $rs = mysqli_query($connection, $query);

    if(mysqli_num_rows($rs)==1){
    $fetch_row = mysqli_fetch_array($rs);
    return $fetch_row;
    }
}

function relateUser($connection, $rows){
    $user_id = $rows['user_id'];
    $query = "SELECT * FROM user where user_id = '$user_id'";

    $rs = mysqli_query($connection, $query);
    if(mysqli_num_rows($rs)==1){
        $fetch_row = mysqli_fetch_array($rs);

    return $fetch_row;
    }
}
?>