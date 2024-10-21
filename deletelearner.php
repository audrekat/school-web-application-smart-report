<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_report";  // Make sure the database name matches your setup

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the learner ID is provided in the URL
if (isset($_GET['id'])) {
    $learner_id = $_GET['id'];

    // SQL query to delete the learner
    $delete_query = "DELETE FROM learner WHERE learner_id = ?";

    // Prepare and bind the statement
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $learner_id);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the list page after successful deletion
        header("Location: list_learners.php?message=success");
        exit();
    } else {
        // Display error if the deletion fails
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    // If no learner ID is provided, redirect back to the list page
    header("Location: learners.php?message=error");
    exit();
}

mysqli_close($conn);
?>
