<?php
// Connect to the smart_report database
$host = 'localhost';
$dbname = 'smart_report';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search query variable
$searchQuery = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = $_POST['search'];
}

// Fetch learners based on search query
$sql = "SELECT learner_id, id_number, name FROM learner";
if (!empty($searchQuery)) {
    $sql .= " WHERE name LIKE '%$searchQuery%' OR id_number LIKE '%$searchQuery%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .dashboard-container {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
            text-align: center;
        }
        .search-container {
            margin-bottom: 20px;
            text-align: right;
        }
        .search-container input {
            padding: 10px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-container button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-btn {
            padding: 10px 15px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #007BFF;
        }

        /* Header styles */
.header {
    position: absolute;
    top: 0;
    width: 100%;
    padding: 0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0056b3;
}

.logo {
    width: 50px;
    height: 50px;
    color: white;
}

.dashboard h1 {
    color: white;

}
    </style>
</head>
<body>
<!-- Header -->
<div class="header">
    <div>
        <img src="1.jpg" alt="Logo" class="logo">
    </div>
    <div class="dashboard">
        <h1>DIOPONG PRIMARY SCHOOL</h1>
    </div>
</div>

<div class="dashboard-container">
    <h1>Teacher Dashboard</h1>

    <!-- Search Bar -->
    <div class="search-container">
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Search by learner name or ID number..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Learners Table -->
    <table>
        <thead>
            <tr>
                <th>Roll No</th>
                <th>ID Number</th>
                <th>Learner Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data for each learner
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['learner_id'] . "</td>";
                    echo "<td>" . $row['id_number'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>
                          <form method='POST' action='now.php'>
                              <input type='hidden' name='learner_id' value='" . $row['learner_id'] . "'>
                              <button type='submit' class='action-btn'>Add Results</button>
                          </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No learners found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
