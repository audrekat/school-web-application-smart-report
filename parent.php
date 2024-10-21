<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Parents</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons a {
            margin-right: 5px;
            text-decoration: none;
        }
        .action-buttons button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<h1>List of Parents</h1>

<table>
    <thead>
        <tr>
            <th>Parent ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>ID Number</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smart_report";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to fetch all parents
        $query = "SELECT * FROM Parent";
        $result = mysqli_query($conn, $query);

        // Check if any records are found
        if (mysqli_num_rows($result) > 0) {
            // Loop through each parent and display them in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['Parent_id']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Surname']}</td>
                        <td>{$row['Parent_id_number']}</td>
                        <td>{$row['Contact']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['Email_address']}</td>
                        <td class='action-buttons'>
                            <a href='learners.php?id={$row['Parent_id']}'><button class='edit-button'>Edit</button></a>
                            <a href='delete_parent.php?id={$row['Parent_id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'><button class='delete-button'>Delete</button></a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No parents found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </tbody>
</table>

</body>
</html>
