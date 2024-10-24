<?php
// Database configuration
$servername = "ioehm.h.filess.io"; 
$username = "fishing_gardenupto"; 
$password = "e8d91974aaf87e9025ad58d778fe202aa518d934"; 
$dbname = "fishing_gardenupto"; 
$port = 3307; // Port number

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an SQL statement
        $stmt = $pdo->prepare("INSERT INTO credentials (email, password) VALUES (:email, :password)");
        
        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Execute the statement
        $stmt->execute();
        
        echo "credentials added successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
