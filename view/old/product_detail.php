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
                                        <a href="#">rental</a>
                                    </div><!-- End .product-cat -->
                                </div><!-- End .product-details-footer -->

                                <div class="product-details-action">
                                    <div class="details-action-col">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                        </div><!-- End .product-details-quantity -->

                                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                    </div><!-- End .details-action-col -->
                                </div><!-- End .product-details-action -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->


                <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                <div class="owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": false,
                                "dots": false
                            }
                        }
                    }'>
                <?php
                while($rows = mysqli_fetch_array($ser_data)){
                    ?>
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            <a href="?id=<?=$rows['item_id']?>">
                                <img src="../assets/image/service/<?= $rows['filename']?>" alt="Product image" class="product-image">
                            </a>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <h3 class="product-title"><a href="product.html"><?= $rows['itemName']?></a></h3><!-- End .product-title -->
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
                    <?php
                        }
                        mysqli_close($connection);
                    ?>
                </div><!-- End .owl-carousel -->
            </div><!-- End .col-lg-9 -->
        </div><!-- End .row -->

    </div><!-- End .container -->
</div><!-- End .page-content -->

<?= require 'footer.php'?>