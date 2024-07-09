<h1 style="color:green;"><?php echo $message; ?></h1>
<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add item</h3>
        <label for="username">Username:</label>
        <input type="text" name="name" placeholder="Enter username" class="box">
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Enter password" class="box">
        <label for="confrim password">Confirm Password:</label>
        <input type="password" name="cpassword" placeholder="Confirm password" class="box">
        <label for="image">Image:</label>
        <input type="file" name="image" class="box">
        <input type="submit" name="submit" class="btn" value="register now">
        <p>Already have an account? <a href="login.php">Login Now</a></p>
    </form>
</div>