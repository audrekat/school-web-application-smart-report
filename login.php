<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_report";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM userlogin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Generate OTP and store it in the session
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['role'] = $user['role'];

            // Send OTP to user via email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'malema'; // Your SMTP username
                $mail->Password = 'your_password'; // Your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                $mail->setFrom('no-reply@diopongprimaryschool.com', 'Diopong Primary School');
                $mail->addAddress($email); // Add recipient
                $mail->Subject = "Your OTP Code";
                $mail->Body = "Your OTP code is: $otp"; // OTP message
                $mail->isHTML(true); // Set email format to HTML

                $mail->send();
                header("Location: verify_otp.php"); // Redirect to OTP verification page
                exit();
            } catch (Exception $e) {
                echo "Error sending OTP: {$mail->ErrorInfo}";
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login_container">
        <form action="" method="post"> 
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
            <div class="form-group">
                <a href="forgot_password.html">Forgot password?</a>
            </div>
        </form>
    </div>
</body>
</html>
