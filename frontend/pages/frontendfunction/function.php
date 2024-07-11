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
                <div class="img"><img src="../productimage/<?php echo $product['image']; ?>" alt="<?php echo $product['name'];?>"></div>
                <div class="desc"><?php echo $product['description'] ;?></div>
                <div class="title"><?php echo $product['name']; ?></div>
                <div class="box">
                    <div class="price">$<?php echo $product['price']; ?></div>
                   
                   <a href="details.php?details=<?php echo $product['id']; ?>" class="btn">View Now</a>
                </div>
            </div>
            <!-- card end -->


<?php
        }
    }

}

?>

<!-- detals page -->


<?php 
// Function to display product details
function details($message = ''){
    include "config.php";
    // Check if 'details' parameter is set in the URL
    if(isset($_GET['details'])){
        // Get the 'details' parameter value
        $id = $_GET['details'];

        
        // Prepare the SQL query to fetch product details by id
        $getproinfo = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");

        // Check if the query was successful
        if($getproinfo){
            // Fetch the product details
            $row = mysqli_fetch_assoc($getproinfo);

            // If product details are found, update the message
            if($row){
                ?>
                 <div class="box_detail">
        <div class="img_detail">
        <img src="../productimage/<?php echo $row['image']; ?>" alt="<?php echo $row['name'];?>">
        </div>

        <div class="star_rating">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-regular fa-star"></i>
        </div>

        <div class="description_detail">
            <p><?php echo $row['description'] ;?></p>
        </div>

        <div class="product_name_detail">
            <div class="name">
            <div class="border_detail">
                <p><?php echo $row['name'] ;?></p>
                </div>
            </div>

            <div class="amount">
            <div class="border_detail">
                <p>$<?php echo $row['price'] ;?></p>
            </div>    
            </div>
            
        </div>
    </div>

                <?php
            } else {
                // If no product found with the given id
                $message = "No product found with the given ID.";
            }
        } else {
            // If the query failed
            $message = "Error retrieving product details.";
        }
    }

    // echo $message;
}


?>
