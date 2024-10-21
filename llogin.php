<?php
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "smart_report"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Collect and sanitize input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

// Check admin table first
$sql_admin = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql_admin);
$stmt->bind_param("s", $username);
$stmt->execute();
$result_admin = $stmt->get_result();
$user = $result_admin->fetch_assoc();

if (!$user) {
    // Check teacher table
    $sql_teacher = "SELECT * FROM teacher WHERE username = ?";
    $stmt = $conn->prepare($sql_teacher);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_teacher = $stmt->get_result();
    $user = $result_teacher->fetch_assoc();
}

if (!$user) {
    // Check parent table
    $sql_parent = "SELECT * FROM parent WHERE username = ?";
    $stmt = $conn->prepare($sql_parent);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_parent = $stmt->get_result();
    $user = $result_parent->fetch_assoc();
}

if ($user) {
    // Directly compare plain text passwords
    if (password_verify($password, $user['password']))
    {
        // Password is correct
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

         // Redirect based on user_type
         switch ($user['user_type']) {
            case 'admin':
                header("Location: admind.html"); // Redirect to admin dashboard
                break;
            case 'teacher':
                header("Location: teacherdashboard.php"); // Redirect teacher dashboard
                break;
            case 'parent':
                header("Location: parentdashboard.php"); // Redirect to parent dashboard
                break;}
        // header("Location: parentdashboard.php "); // Redirect to the dashboard
        // exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$conn->close();
?>
