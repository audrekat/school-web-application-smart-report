<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Header styling */
        .header {
            background-color: #0056b3;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .header h1 {
            margin: 0;
        }

        .dashboard h1{
            color: white;
        }

        .logo {
            width: 60px;
            height: 60px;
        }

        /* Table styling */
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #0056b3;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Button styles */
        .view-button {
            background-color: #007bff; /* Blue for View */
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .view-button:hover {
            background-color: white;
            color: #007bff;
        }

        h1 {
            text-align: center;
            color: #0056b3;
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

    <h1>Your Learners</h1>

    <table>
        <thead>
            <tr>
                <th>Learner ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
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

            // Assuming you have the parent_id available from session or passed via URL
            $parent_id = 18; // Replace with actual parent ID

            // Query to fetch all learners for the parent
            $query = "SELECT learner_id, name, surname, grade 
                      FROM learner 
                      WHERE parent_id = $parent_id"; // Adjust the query based on your table structure

            $result = mysqli_query($conn, $query);

            // Check if any records are found
            if (mysqli_num_rows($result) > 0) {
                // Loop through each learner and display them in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['learner_id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['surname']) . "</td>
                            <td>" . htmlspecialchars($row['grade']) . "</td>
                            <td>
                                <a href='learner_report.php?id=" . $row['learner_id'] . "'>
                                    <button class='view-button'>View</button>
                                </a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No learners found</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
