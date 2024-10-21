<?php
// Include the Composer autoload file
require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Database configuration
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

// Collect and sanitize form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$surname = mysqli_real_escape_string($conn, $_POST['surname']);
$id_number = mysqli_real_escape_string($conn, $_POST['id_number']);
$gender = mysqli_real_escape_string($conn, $_POST['Gender']); // Check form field name
$email = mysqli_real_escape_string($conn, $_POST['Email']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$registration_date = mysqli_real_escape_string($conn, $_POST['registration_date'] ?? '');
$password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);
$user_type =  mysqli_real_escape_string($conn, $_POST['user_type']); // Define user type

// Corrected SQL query

$sql_query = "INSERT INTO `parent` (`name`, `surname`, `id_number`, `contact`, `address`, `email`, `registration_date`, `user_type`, `username`, `gender`, `password`) VALUES ('$name', '$surname', '$id_number', '$contact', '$address', '$email', '$registration_date', '$user_type', '$username', '$gender', '$password')";


if ($conn->query($sql_query) === TRUE) {
    echo "New parent registered successfully<br>";
     echo "Hashed Password: " . $password . "<br>"; // Debugging line

    // Send confirmation email
    $mail = new PHPMailer(true);
    
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'audreymmakaepea@gmail.com'; 
        $mail->Password = 'ttxn rwfb uevr mbbr'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

        // Recipients
        $mail->setFrom('your-email@example.com', 'Your Name'); 
        $mail->addAddress($email, "$name $surname"); 

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Registration Successful';
        $mail->Body = "Hi $name,<br><br>Thank you for registering as a parent! Use this information to login to our system <br>
        username: $username <br> password: $password.<br>Best regards,<br>Your Organization";
        

        $mail->send();
        echo 'Confirmation email has been sent.';
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Error: " . $sql_query . "<br>" . $conn->error;
}

$conn->close();
?>
