

<?php
function addproduct($message = '')
{
    include 'include/db/config.php';

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']["name"];
        $image_tmp = $_FILES['image']['tmp_name'];
    
        // Validate image file
        $check = getimagesize($image_tmp);
        if($check !== false) {
            // File is an image
    
            // Create a unique name for the image
            $image_extension = pathinfo($image, PATHINFO_EXTENSION); // Get the image extension
            $unique_image_name = time() . '_' . uniqid() . '.' . $image_extension; // Generate a unique name
    
            // Save image with unique name
            $destination = "../frontend/productimage/$unique_image_name";
            if (move_uploaded_file($image_tmp, $destination)) {
                // "Image uploaded successfully to $destination";
    
                // Inserting the data into the database
                $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
    
                if ($stmt) {
                    $stmt->bind_param("ssss", $name, $price, $description, $unique_image_name);
    
                    if ($stmt->execute()) {
                        $message = "Item added";
                    } else {
                        $message = "An error occurred while executing the statement.";
                    }
    
                    $stmt->close();
                } else {
                    $message = "An error occurred while preparing the statement.";
                }
            } else {
                $message = "Failed to move the uploaded file.";
            }
        } else {
            $message = "File is not an image.";
        }
    
        echo $message;
    }
    ?>
    <h1 style="color:green; text-align:center;"><?php echo $message; ?></h1>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add item</h3>
            <label for="itemname">Item name:</label>
            <input type="text" name="name" placeholder="Enter item name" class="box" id="itemname">
            <label for="price">Price:</label>
            <input type="number" name="price" placeholder="Price" class="box" id="price">
            <label for="description">Description:</label>
            <textarea name="description" class="box" id="description"></textarea>
            <label for="image">Image:</label>
            <input type="file" name="image" class="box" id="image">
            <input type="submit" name="submit" class="btn" value="Save">
        </form>
    </div>
    <?php
}

function addcategory()
{
    include 'include/db/config.php';
   
    $message='';
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        if (empty($name)) {
            $message = "Name is empty";
        } else {
            // checking if data name is in the category table
         $sql="SELECT * FROM category WHERE name=?";
         $stmt=$conn->prepare($sql);
         $stmt->bind_param("s",$name);
         $stmt->execute();
         $results=$stmt->get_result();
         $count=$results->num_rows;
         $stmt->close();

        //  checking if the input name exist
        if($count>0){
            // do something
            $message="The category name already exist";
        }else{
            // do something
          $stmt=$conn->prepare("INSERT INTO category (name)VALUES(?)");
          $stmt->bind_param("s",$name);
          
           if($stmt->execute()){
            $message="Category added succesfully!";
           }else{
            $message="An error occured, please try again!";
           }
        }


        }
    }
    ?>
    <h1 style="text-align:center;"><?php echo $message; ?></h1>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Category</h3>
            <label for="categoryname">Category name:</label>
            <input type="text" name="name" placeholder="Enter category name" class="box" id="categoryname">
            <input type="submit" name="submit" class="btn" value="register now">
        </form>
    </div>
    <?php
}

function viewProduct()
{
    include 'include/db/config.php';
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql="SELECT * FROM products";
            $run=$conn->query($sql);
            if($run->num_rows>0){
                while($data=$run->fetch_assoc()){
                    ?>

<tr>
                <th scope="row"><?php echo $data['name']; ?></th>
                <td>$<?php echo $data['price']; ?></td>
                <td><img height="100px" width="100px" class="backendimg" src="../frontend/productimage/<?php echo $data['image']; ?>" alt=""></td>
                <td><a href="">Update</a></td>
                <td><a href="">Delete</a></td>
            </tr>
<?php
                }
            }
            ?>
          
           
        </tbody>
    </table>
    <?php
}
?>