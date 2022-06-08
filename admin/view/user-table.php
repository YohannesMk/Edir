<?php
require_once('../controller/connect.php');
$export_id = 1;
require_once 'admin-header.php';


$sql = "SELECT * FROM user";
$result = mysqli_query($connection, $sql);

if($_SERVER["REQUEST_METHOD"]=="POST"){
   $user_id = $_POST['user_id'];
   
  
   if(isset($_POST["is_active"])){
        $sql = "UPDATE user SET is_active = 1 WHERE user_id = '$user_id' ";
   }

    else{
        $sql = "UPDATE user SET is_active = 0 WHERE user_id = '$user_id' ";
    }

    mysqli_query($connection, $sql);
    echo '<script>load();</script>';

   
}

if(isset($_GET['search']))
  {
   $search = $_GET['search'];
  
    $query="SELECT * FROM user where fName like '%$search%' OR mName like '%$search%' OR lName like '%$search%' OR email like '%$search%'";
    $result = mysqli_query($connection, $query);
    if($result)
    {
        echo "Form Inserted Succesfully!";
    }
  }

?>

<div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
        <div class="row align-items-center">
            <h3 class="box-title">User Table</h3>
        </div>
        
        <div class="table-responsive">
            <table class="table text-nowrap">
            <thead>
                <tr>
                <th class="border-top-10"></th>
                <th class="border-top-0"></th>
                <th class="border-top-0">Is active</th>
                <th class="border-top-0">User Id</th>
                <th class="border-top-0">First Name</th>
                <th class="border-top-0">Last Name</th>
                <th class="border-top-0">Email</th>
                <th class="border-top-0">DOB</th>
                <th class="border-top-0">Gender</th>
                <th class="border-top-0">Address</th>
                <th class="border-top-0">Phone No.</th>
                <th class="border-top-0">House No.</th>
                <th class="border-top-0">password</th> 
                <th class="border-top-0">date_joined</th> 
                </tr>
            </thead>
            <tbody>
            
            <?php   // LOOP TILL END OF DATA 
                while($rows = mysqli_fetch_array($result))
                { 
                ?>
                <tr>
            <form method="POST" action="">
                <td>
                    <div class="col-sm-6 col-md-6 col-lg-3 f-icon">
                        <button type="submit"><i class="fas fa-pencil-alt"></i><span>update</span></button>
                    </div>
                <td>
                <td>
                    <input type="hidden" name="user_id" value="<?=$rows['user_id']?>">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" <?php if($rows['is_active']==1){echo 'checked';}else{echo 'none';}?> value="<?=$rows['user_id']?>" id="flexCheckDefault" />
                    </div>
                </td>
            </form>
                <td name="user"><?php echo $rows['user_id']?></td>
                <td><?php echo $rows['fName']?></td>
                <td><?php echo $rows['lName']?></td>
                <td><?php echo $rows['email']?></td>
                <td><?php echo $rows['dob']?></td>
                <td><?php echo $rows['gender']?></td>
                <td><?php echo $rows['address']?></td>
                <td><?php echo $rows['phoneNo']?></td>
                <td><?php echo $rows['houseNum']?></td>
                <td><?php echo $rows['password']?></td>
                <td><?php echo $rows['date_joined']?></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>

<?= require_once 'admin-footer.php'?>