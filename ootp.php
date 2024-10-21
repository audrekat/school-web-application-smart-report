<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];

    if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
        if (time() < $_SESSION['otp_expiry']) {
            if ($entered_otp == $_SESSION['otp']) {
                echo "Access granted! Welcome, " . $_SESSION['username'] . ".";
                // Clear OTP after successful verification
                unset($_SESSION['otp']);
                unset($_SESSION['otp_expiry']);
                header("Location: admind.html"); // Redirect to the dashboard
                exit();
            } else {
                echo "Invalid OTP. Please try again.";
            }
        } else {
            echo "OTP has expired. Please log in again.";
            unset($_SESSION['otp']);
            unset($_SESSION['otp_expiry']);
        }
    } else {
        echo "No OTP session found. Please log in again.";
    }
}
?>
