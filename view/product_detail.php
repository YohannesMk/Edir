<?php
    require_once 'header.php';
    require_once '../controller/connect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    else{
        echo "incorrect slug";
    }
    $query = "SELECT * FROM service WHERE item_id = $id limit 1";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_array($result);
    }
    
    if(isset($_POST['bottom-submit'])){
        $item_id = $_POST['bottom-item-id'];

        $date_start = date("Y-m-d");
        $date_return = date("Y-m-d");
        $qty = 1;
        
        $cart_item_result = mysqli_query($connection, "SELECT * FROM cart where item_id = '$item_id' and user_id = '$user_id'");
        $cart_row = mysqli_fetch_array($cart_item_result);
        if(!empty($cart_row)){
            if($item_id != $cart_row['item_id']){
                $cartSql = "INSERT INTO cart(user_id, item_id, quantity, date_start, date_return) VALUES ($user_id, $item_id, $qty, $date_start ,$date_return)";
            }
            else{
                $cartSql = "UPDATE cart SET quantity='$qty', date_start ='$date_start', date_return = '$date_return' WHERE user_id = $user_id AND item_id = $item_id";
            }
        }
        else{
            $cartSql = "INSERT INTO cart(user_id, item_id, quantity, date_start ,date_return) VALUES ($user_id, $item_id, $qty, $date_start ,$date_return)";
        }

        mysqli_query($connection,$cartSql);

    }

    if(isset($_POST['product-submit'])){
        $qty = $_POST['product-qty'];
        $item_id = $_POST['product-id'];
        $start_date = $_POST['date_start'];
     
        $return_date = $_POST['date_return'];

        $cart_item_result = mysqli_query($connection, "SELECT * FROM cart where item_id = '$item_id' and user_id = '$user_id'");
        $cart_row = mysqli_fetch_array($cart_item_result);
    if($start_date<=$return_date){

        if(!empty($cart_row)){
            if($item_id != $cart_row['item_id']){
                $cartSql = "INSERT INTO cart(user_id, item_id, quantity, date_start, date_return) VALUES ($user_id, $item_id, $qty, $start_date ,$return_date)";
            }
            else{
                $cartSql = "UPDATE cart SET quantity='$qty', date_start = '$start_date', date_return = '$return_date' WHERE user_id = $user_id AND item_id = $item_id";
            }
        }
        else{
            $cartSql = "INSERT INTO cart(user_id, item_id, quantity, date_start, date_return) VALUES ($user_id, $item_id, $qty, $start_date ,$return_date)";
        }
        mysqli_query($connection,$cartSql);
    }else{
            echo '<script>alert("please check the start and end date");</script>';
    }
    }
    
    $ser_sql = "SELECT * FROM service where item_id<>'$id' ORDER BY date_updated limit 4";
    $ser_data = mysqli_query($connection,$ser_sql);
?>
<div class="page-content">
    <div class="container">
        <div class="row mt-4">
            <div class="col">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="../assets/image/service/<?= $row['filename']?>" data-zoom-image="assets/images/products/single/sidebar-gallery/1-big.jpg" alt="product image">
                                </figure><!-- End .product-main-image -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <form method="POST">
                                <div class="product-details product-details-sidebar">
                                    <h1 class="product-title"><?= $row['itemName']?></h1><!-- End .product-title -->
                                    
                                    <div class="product-price">
                                        $<?=$row['price']?>
                                    </div><!-- End .product-price -->
                                    
                                    <div class="product-content">
                                        <p><?= $row['description']?></p>
                                    </div><!-- End .product-content -->

                                    <div class="product-details-footer details-footer-col">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a>Rental</a>
                                        </div><!-- End .product-cat -->
                                    </div><!-- End .product-details-footer -->

                                    <div class="product-details-action">
                                        <div class="details-action-col">
                                            <label for="qty">Qty:</label>
                                            <div class="product-details-quantity">
                                                <input type="number" id="qty" name="product-qty" class="form-control" value="1" min="1" max="<?=$row['quantity']?>" step="1" data-decimals="0" required>
                                            </div>

                                            <label for="date_start">Start Date:</label>
                                            <div class="product-details-quantity">
                                                <input type="date" id="date_start" name="date_start" class="form-control" required>
                                            </div>

                                            <label for="date_return">Return Date:</label>
                                            <div class="product-details-quantity">
                                                <input type="date" id="date_return" name="date_return" class="form-control" required>
                                            </div>
                                        </div><!-- End .details-action-col -->
                                        <input type="hidden" name="product-id" value="<?=$row['item_id']?>">
                                        <button type="submit" name="product-submit" class="btn-product btn-cart"><span>Add to cart</span></a>
                                    </div><!-- End .product-details-action -->
                                </div><!-- End .product-details -->
                            </form>
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->


                <h2 class="title text-center mt-4 mb-4">You May Also Like</h2><!-- End .title text-center -->
                <div class="row">
                <?php
                while($rows = mysqli_fetch_array($ser_data)){
                    ?>
                        <div class="col-lg-3">
                           <form method="POST">
                                <div class="product product-7 shadow text-center">
                                    <figure class="product-media">
                                        <a href="?id=<?=$rows['item_id']?>">
                                            <img src="../assets/image/service/<?= $rows['filename']?>" alt="Product image" class="product-image">
                                        </a>
                                        <div class="product-action">
                                            <button type="submit" name="bottom-submit" class="btn-product btn-cart"><span>Add to cart</span></button>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <input type="hidden" name="bottom-item-id" value="<?=$rows['item_id']?>">
                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.php?cat=<?= $rows['itemName']?>"><?= $rows['itemName']?></a></h3><!-- End .product-title -->
                                        <p><?php 
                                        if(strlen($rows['description'])>50){
                                            $stringCut = substr($rows['description'], 0, 50);
                                            $endPoint = strrpos($stringCut, '.');
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            echo $string;
                                        } 
                                        else{
                                            echo $rows['description'];
                                        }
                                        ?></p>

                                        <div class="product-price">
                                            $<?= $rows['price']?>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </form>
                        </div>
                    <?php
                        }
                    mysqli_close($connection);
                    ?>
                </div><!-- End .owl-carousel -->
            </div><!-- End .col-lg-9 -->
        </div><!-- End .row -->

    </div><!-- End .container -->
</div><!-- End .page-content -->

<?= require_once 'footer.php'?>