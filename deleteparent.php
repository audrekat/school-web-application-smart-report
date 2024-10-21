<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_report"; // Make sure the database name matches your setup

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $parent_id = intval($_GET['id']); // Get the parent ID from the URL and sanitize it

    // SQL query to delete the parent from the 'parent' table
    $sql = "DELETE FROM parent WHERE parent_id = ?";

    // Prepare and bind the statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $parent_id);

        if ($stmt->execute()) {
            // Redirect to the parent list page after successful deletion
            header("Location: prc.php?message=Parent+Deleted+Successfully");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
} else {
    echo "No parent ID provided.";
}

// Close the database connection
mysqli_close($conn);
?>
