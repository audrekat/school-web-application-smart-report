<?php
// Connection to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all teachers
$sql = "SELECT * FROM teacher";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Teachers</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .h1{
            margin-top: 100px;
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

    <div class="h1"><h1>All Teachers</h1></div>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>ID Number</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
        <?php while ($teacher = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $teacher['Teacher_ID']; ?></td>
            <td><?php echo $teacher['Name']; ?></td>
            <td><?php echo $teacher['Surname']; ?></td>
            <td><?php echo $teacher['id_number']; ?></td>
            <td><?php echo $teacher['gender']; ?></td>
            <td><?php echo $teacher['Email']; ?></td>
            <td><?php echo $teacher['Contact']; ?></td>
            <td>
                <a href="edit_teacher.php?teacher_id=<?php echo $teacher['Teacher_ID']; ?>">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
