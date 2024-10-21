<?php
// Assume you have a connection to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you pass a parent ID to this page via GET or POST
$parent_id = isset($_GET['parent_id']) ? intval($_GET['parent_id']) : 1; // Default to parent_id 1

// Fetch parent details
$sql = "SELECT * FROM parent WHERE parent_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result = $stmt->get_result();
$parent = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Parent Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #0056b3;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #003d7a;
        }
    </style>
</head>
<body>

<!-- Back Button -->
<a href="dashboard.php" class="back-btn">Back</a>

<!-- Header -->
<div class="header">
    <div>
        <img src="1.jpg" alt="Logo" class="logo">
    </div>
    <div class="dashboard">
        <h1>DIOPONG PRIMARY SCHOOL</h1>
    </div>
</div>

<form action="update_parent.php" method="post">
    <div class="addcontainer">
        <h1>Update Parent Details</h1>
        <hr>

        <!-- Hidden field for parent_id -->
        <input type="hidden" name="parent_id" value="<?php echo $parent['parent_id']; ?>">

        <label for="name"><b>Name(s):</b></label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($parent['name']); ?>" required>

        <label for="surname"><b>Surname:</b></label>
        <input type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($parent['surname']); ?>" required>

        <label for="id_number"><b>ID Number:</b></label>
        <input type="text" name="id_number" id="id_number" value="<?php echo htmlspecialchars($parent['id_number']); ?>" required>

        <label for="gender"><b>Gender:</b></label>
        <select name="gender" id="gender" required>
            <option value="male" <?php if ($parent['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($parent['gender'] == 'female') echo 'selected'; ?>>Female</option>
        </select>
        <br><br>

        <label for="address"><b>Physical Address:</b></label>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($parent['address']); ?>" required>

        <label for="email"><b>Email Address:</b></label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($parent['email']); ?>" required>

        <label for="contact"><b>Contact:</b></label>
        <input type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($parent['contact']); ?>" required>

        <label for="user_name"><b>Username:</b></label>
        <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($parent['username']); ?>" required>

        <label for="user_type"><b>User Type:</b></label>
        <input type="text" name="user_type" id="user_type" value="<?php echo htmlspecialchars($parent['user_type']); ?>" required>

        <hr>
        <button type="submit" class="registerbtn">Update Details</button>
    </div>
</form>

</body>
</html>
