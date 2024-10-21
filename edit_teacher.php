<?php
// Assume you have a connection to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted to update teacher details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $teacher_id = $_POST['Teacher_ID'];  // Assuming you're passing the teacher ID from a hidden input
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $id_number = $_POST['id_number'];
    $gender = $_POST['gender'];
    $email = $_POST['Email'];
    $contact = $_POST['Contact'];

    // Update query
    $sql = "UPDATE teacher SET name=?, Surname=?, id_number=?, gender=?, Email=?, Contact=? WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $name, $surname, $id_number, $gender, $email, $contact, $teacher_id);

    if ($stmt->execute()) {
        echo "Teacher details updated successfully!";
    } else {
        echo "Error updating teacher details: " . $conn->error;
    }

    $stmt->close();
}

// Fetch teacher details to pre-fill form for updating
$teacher_id = isset($_GET['teacher_id']) ? intval($_GET['teacher_id']) : 1; // Default to teacher_id 1 for example
$sql = "SELECT * FROM teacher WHERE teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <link rel="stylesheet" href="styles.css">
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

<form action="" method="post">
    <div class="addcontainer">
        <h1>Update Teacher Details</h1>
        <hr>
        
        <!-- Hidden field to store teacher_id -->
        <input type="hidden" name="teacher_id" value="<?php echo $teacher['Teacher_ID']; ?>">

        <label for="name"><b>Name(s):</b></label>
        <input type="text" name="name" id="name" value="<?php echo $teacher['Name']; ?>" required>

        <label for="surname"><b>Surname:</b></label>
        <input type="text" name="surname" id="surname" value="<?php echo $teacher['Surname']; ?>" required>

        <label for="id_number"><b>ID Number:</b></label>
        <input type="text" name="id_number" id="id_number" value="<?php echo $teacher['id_number']; ?>" required>

        <label for="gender"><b>Gender:</b></label>
        <select name="gender" id="gender" required>
            <option value="female" <?php if ($teacher['gender'] == 'female') echo 'selected'; ?>>Female</option>
            <option value="male" <?php if ($teacher['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="other" <?php if ($teacher['gender'] == 'other') echo 'selected'; ?>>Other</option>
        </select>

        <label for="email"><b>Email Address:</b></label>
        <input type="email" name="email" id="email" value="<?php echo $teacher['Email']; ?>" required>

        <label for="contact"><b>Contact:</b></label>
        <input type="text" name="contact" id="contact" value="<?php echo $teacher['Contact']; ?>" required>

        <hr>
        <button type="submit" class="registerbtn">Update</button>
    </div>
</form>

</body>
</html>
