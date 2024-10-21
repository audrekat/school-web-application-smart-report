<?php
// Include Composer's autoload file
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $id_number = $_POST['id_number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $user_type = $_POST['user_type'];
    
    // Validate ID number
if (!preg_match('/^\d{13}$/', $id_number)) {
    die("Error: ID Number must be exactly 13 digits long.");
}

    // Generate a random password and hash it
    $password = bin2hex(random_bytes(4));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Set registration date
    $registration_date = date('Y-m-d H:i:s');

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'smart_report');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert parent data
        $sql_parent = "INSERT INTO parent (name, surname, id_number, gender, address, email, contact, username, user_type, password, registration_date) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_parent = $conn->prepare($sql_parent);
        $stmt_parent->bind_param('sssssssssss', $name, $surname, $id_number, $gender, $address, $email, $contact, $username, $user_type, $hashed_password, $registration_date);
        
        if (!$stmt_parent->execute()) {
            throw new Exception("Error inserting into parent table: " . $stmt_parent->error);
        }

        // Insert into userlogin table
        $sql_userlogin = "INSERT INTO userlogin (email, password, role) VALUES (?, ?, ?)";
        $stmt_userlogin = $conn->prepare($sql_userlogin);
        $stmt_userlogin->bind_param('sss', $username, $hashed_password, $user_type);
        
        if (!$stmt_userlogin->execute()) {
            throw new Exception("Error inserting into userlogin table: " . $stmt_userlogin->error);
        }

        // Commit the transaction
        $conn->commit();

        // Send confirmation email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'malemamahlatse70@gmail.com';
            $mail->Password = 'cdbhkiurykowykqw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('malemamahlatse70@gmail.com', 'Mahlatse');
            $mail->addAddress($email, "$name $surname");

            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body    = "Hello $name,<br><br>Your registration was successful. Your username is $username and your password is $password.<br><br>Thank you!";
            $mail->AltBody = "Hello $name,\n\nYour registration was successful. Your username is $username and your password is $password.\n\nThank you!";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Retrieve emails from the parent table
        try {
            $sql = "SELECT email FROM parent";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $emails = [];
                while ($row = $result->fetch_assoc()) {
                    $emails[] = $row['email'];
                }

                foreach ($emails as $email) {
                    echo $email . "<br>";
                }
            } else {
                echo "No emails found.";
            }
        } catch (Exception $e) {
            echo "Error retrieving emails: " . $e->getMessage();
        }

        // Redirect to addlearner.html
        header("Location: addlearner.html");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }

    // Close the connections
    $stmt_parent->close();
    $stmt_userlogin->close();
    $conn->close();
}
?>
