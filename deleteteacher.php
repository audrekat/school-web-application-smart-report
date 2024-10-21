<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if teacher_id is set
if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM teacher WHERE teacher_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teacher_id);

    if ($stmt->execute()) {
        echo "Teacher deleted successfully!";
    } else {
        echo "Error deleting teacher: " . $conn->error;
    }

    $stmt->close();
}

// Close connection
$conn->close();

// Redirect back to the View All Teachers page
header("Location: viewteachers.php");
exit();
?>
