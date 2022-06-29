<?php
require_once '../controller/connect.php';
require_once '../controller/functions.php';
require_once 'header_Amh.php';

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$subtotal_query = "SELECT * FROM cart  WHERE user_id = '$user_id'";
$sub_result = mysqli_query($connection, $subtotal_query);
$subtotal_price = 0;

while($cart_rows = mysqli_fetch_array($sub_result)){
    $return = relateService($connection, $cart_rows);
    $subtotal_price += (double)$return['price'] * (double)$cart_rows['quantity'];
}

$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM Cart WHERE user_id = '$user_id' ";
$result = mysqli_query($connection, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM Cart  WHERE user_id = '$user_id' LIMIT $offset, $no_of_records_per_page";

    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['refresh'])){
        $qty = $_POST['qty'];
        $cart_id = $_POST['cart_id'];
        $csql = "UPDATE Cart SET quantity = '$qty' where cart_id = '$cart_id'";
        mysqli_query($connection,$csql);

    }
    else if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['remove'])){
        $cart_id = $_POST['cart_id'];
        $csql = "DELETE FROM Cart WHERE cart_id = '$cart_id'";
        mysqli_query($connection,$csql);
    }
    


$res_data = mysqli_query($connection,$sql);

?>

<?php 

?>

<div class="page-header text-center" style="background-image: url('../resources/images/dinkuan.jpg')">
    <div class="container">
        <h1 class="page-title" STYLE="color: white">የግዢ ጋሪ<span STYLE="color: orange">ሱቅ</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->

<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <table class="table table-cart table-mobile">
                        <thead>
                            <tr>
                                <th>ምርት</th>
                                <th>ዋጋ</th>
                                <th>ብዛት</th>
                                <th>ጠቅላላ</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($rows = mysqli_fetch_array($res_data)){
                                    ?>
                                    <form method="POST">
                                        <tr>
                                            <input type="hidden" name="item_id" value="<?=$rows['item_id']?>"/>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="../assets/image/service/<?php
                                                                $return = relateService($connection, $rows);
                                                                echo $return['filename'];
                                                                ?>" alt="Product image">
                                                        </a>
                                                    </figure>
                                                    
                                                    <h3 class="product-title">
                                                        <a href="#"><?php
                                                        $return = relateService($connection, $rows);
                                                        echo $return['itemName'];
                                                        ?></a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col">$<?php
                                                        $return = relateService($connection, $rows);
                                                        echo $return['price'];
                                                        ?></td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" name="qty" class="form-control" value="<?=$rows['quantity']?>" min="1" max="<?php $return = relateService($connection, $rows); echo $return['quantity']?>" step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
                                            <td class="total-col">$<?php
                                                        $return = relateService($connection, $rows);
                                                        $total_price =  (double)$return['price'] * (double)$rows['quantity'];
                                                        echo $total_price;
                                                        ?></td>
                                            <input type="hidden" name="cart_id" value="<?=$rows['cart_id']?>">
                                            <td class="remove-col"><button type="submit" name="remove" class="btn-remove"><i class="icon-close"></i></button></td>
                                            <td class="remove-col"><button type="submit" name="refresh" class="btn-remove"><i class="icon-refresh"></i></button></td>
                                        </tr>
                                    </form>
                                <?php
                                    }
                                ?>
                            </tbody>
                    </table><!-- End .table table-wishlist -->
                    </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">ጋሪ ጠቅላላ</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <tbody>
                                <tr class="summary-shipping">
                                    <td>እቃዎች:</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php $sub_result = mysqli_query($connection, $subtotal_query);
                                        while($crow = mysqli_fetch_array($sub_result)){?>

                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="">
                                                <label class="" for="standart-shipping"><?php echo relateService($connection,$crow)['itemName'];?>:</label>
                                            </div>
                                        </td>
                                    <td>$<?php
                                        $return = relateService($connection, $crow);
                                        $total_price =  (double)$return['price'] * (double)$crow['quantity'];
                                        echo $total_price;
                                    ?></td>
                                </tr><!-- End .summary-shipping-row -->

                                <?php }
                                    mysqli_close($connection);
                                ?>
                                <tr class="summary-total">
                                    <td>ጠቅላላ:</td>
                                    <td>$<?=$subtotal_price?></td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <a href="checkout_Amh.php" class="btn btn-outline-primary-2 btn-order btn-block">ወደ መውጫ ቀጥሉ</a>
                    </div><!-- End .summary -->

                    <a href="product_Amh.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>ግብይት ቀጥል</span><i class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->

<?php require_once 'footer_Amh.php'; ?>