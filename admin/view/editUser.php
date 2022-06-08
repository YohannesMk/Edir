<?php
require_once '../controller/connect.php';
require_once 'admin-header.php';


$fetch_sql = "SELECT * FROM user where user_id = '$admin_id' limit 1";

$fetch_result = mysqli_query($connection, $fetch_sql);
if(mysqli_num_rows($fetch_result)==1){
    $fetch_row = mysqli_fetch_array($fetch_result);
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["update"]))
  {
    $fName= $_POST['fName'];
    $mName = $_POST['mName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneNo = $_POST['phoneNo'];
    $houseNum=$_POST['houseNum'];
    $password =  mysqli_real_escape_string($connection, md5($_POST['password']));

    $query="UPDATE user SET fname='$fName', mName='$mName', lName='$lName', email='$email', gender='$gender', address='$address', phoneNo='$phoneNo', houseNum='$houseNum', password='$password' where user_id='$admin_id';";

    if(mysqli_query($connection, $query))
    {
        echo "Form Inserted Succesfully!";
    }
     
      mysqli_close($connection);
  }


?>
        <div class="container-fluid">
          <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-12">
              <div class="white-box">
                <div class="user-bg">
                  <img
                    width="100%"
                    alt="user"
                    src="../../edir final MVC/profile/uploaded_img/<?=$fetch_row['profile']?>"
                  />
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">First Name:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" name="fName" value="<?php echo $fetch_row['fName'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                        
                       
                        
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Last Name:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="lName" type="text" value="<?php echo $fetch_row['lName'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                       
                        <div class="form-group mb-4">
                            <label class="col-sm-12">Gender: </label>

                            <div class="col-sm-12 border-bottom">
                                <select name="gender" class="
                                    form-select
                                    shadow-none
                                    p-0
                                    border-0
                                    form-control-line
                                ">
                                <option <?php if($fetch_row['gender']=="male"){echo 'selected';}?>>Male</option>
                                <option <?php if($fetch_row['gender']=="female"){echo 'selected';}?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Email: </label>
                          <div class="col-md-12 border-bottom p-0">
                            <input name="email"
                              type="email"
                                value="<?php echo $fetch_row['email'];?>"
                              class="form-control p-0 border-0"
                            />
                          </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Address:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="address" type="text" value="<?php echo $fetch_row['address'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Phone No: </label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="phoneNo" type="text" value="<?php echo $fetch_row['phoneNo'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                        
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">House Number:</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="houseNum" type="text" value="<?php echo $fetch_row['houseNum'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>

                    <div class="form-group mb-4">
                      <label class="col-md-12 p-0">Password: </label>
                            <div class="col-md-12 border-bottom p-0">
                                <input name="password" type="password" value="<?php echo $fetch_row['password'];?>" class="form-control p-0 border-0" />
                            </div>
                        </div>
                       
                        <div class="form-group mb-4">
                            <div class="col-sm-12">
                                <button name="update" class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

    </div>
    <?= require_once 'admin-footer.php'?>