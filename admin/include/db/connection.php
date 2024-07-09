
<?php

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    description VARCHAR(50),
    image VARCHAR(30) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
 //   echo "Table Users created or already exists\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}


// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS cart (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    qty INT NOT NULL,
    total_price DECIMAL(8,2) NOT NULL,
    image VARCHAR(50),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
   // echo "Table cart created or already exists\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}



// Create table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS category (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
   // echo "Table cart created or already exists\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}





// Close connection
// $conn->close();
?>
