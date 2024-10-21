<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_otp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $entered_otp == $_SESSION['otp']) {
        echo "OTP verified successfully. You can now access the dashboard.";
        // Redirect to the respective dashboard based on user type
        switch ($_SESSION['user_type']) {
            case 'admin':
                header("Location: admind.html");
                break;
            case 'teacher':
                header("Location: teacherdashboard.php");
                break;
            case 'parent':
                header("Location: parentdashboard.php");
                break;
        }
        exit();
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

<form method="POST">
    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" required>
    <input type="submit" value="Verify OTP">
</form>
