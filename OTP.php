<?php
session_start();
require 'vendor/autoload.php'; // Include Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
$password = $_POST['password']; // User input

// SQL query to check user credentials
$sql = "SELECT * FROM parent WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    $sql_teacher = "SELECT * FROM teacher WHERE username = '$username'";
    $result_teacher = mysqli_query($conn, $sql_teacher);
    $user = mysqli_fetch_assoc($result_teacher);
}

// If not found in teacher, check the admin table
if (!$user) {
    $sql_admin = "SELECT * FROM admin WHERE username = '$username'";
    $result_admin = mysqli_query($conn, $sql_admin);
    $user = mysqli_fetch_assoc($result_admin);
}

if ($user) {
    // Directly compare plain text passwords
    if (password_verify($password, $user['password'])) {
        // Password is correct
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp; // Store OTP in session for later verification
        
        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'malemamahlatse70@gmail.com';
            $mail->Password = 'cdbhkiurykowykqw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('malemamahlatse70@gmail.com', 'Mahlatse');
            $mail->addAddress($email, "$name $surname");


            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "Your OTP code is <strong>$otp</strong>. Please enter this code to proceed.";

            $mail->send();
            echo "OTP has been sent to your email. Please check your inbox.";

            // Optionally, redirect to OTP verification page
            // header("Location: otp_verification.php");
            // exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$conn->close();
?>
