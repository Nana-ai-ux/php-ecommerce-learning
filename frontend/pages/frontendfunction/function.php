<?php
function getproduct(){
    include "config.php";

    $sql="SELECT * FROM products";
    $run=$conn->query($sql);
    if($run->num_rows>0)
    {
        while($product=$run->fetch_assoc()){
            ?>
<!-- card start -->
<div class="card">
                <!-- <div class="img"><img src="../images/Fashion bag.jpg" alt=""></div> -->
                <div class="img"><img src="../productimage/<?php echo $product['image']; ?>" alt=""></div>
                <div class="desc"><?php echo $product['description'] ;?></div>
                <div class="title"><?php echo $product['name']; ?></div>
                <div class="box">
                    <div class="price">$<?php echo $product['price']; ?></div>
                    <button class="btn">Buy Now</button>
                </div>
            </div>
            <!-- card end -->


<?php
        }
    }

}

?>