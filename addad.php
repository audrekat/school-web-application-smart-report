<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "smart_report"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin data to be added
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Use lowercase
    $user_type = $_POST['user_type']; // Ensure this matches the variable name
    $username = $_POST['username'];

    // Prepare and execute the SQL insert
    $sql = "INSERT INTO admin (Name, Surname, Email, password, user_type, username) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Bind parameters using the correct variable names
    $stmt->bind_param("ssssss", $name, $surname, $email, $hashed_password, $user_type, $username);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $success_message = "Admin registered successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>

<form action="adda.php" method="post">
    Name: <input type="text" name="name" required><br>
    Surname: <input type="text" name="surname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Username: <input type="text" name="username" required><br>
    User Type: <input type="text" name="user_type" required><br>
    <input type="submit" value="Add Admin">
</form>

<?php
// Display success or error message
if (isset($success_message)) {
    echo $success_message;
} elseif (isset($error_message)) {
    echo $error_message;
}
?>
