<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get learner_id from the URL or set a default for testing
$learner_id = isset($_GET['learner_id']) ? intval($_GET['learner_id']) : 14;

if (!$learner_id) {
    die("Invalid learner ID.");
}

// Fetch the learner details based on the learner_id
$sql = "SELECT name, surname, id_number, date_of_birth, gender, address, grade FROM learner WHERE learner_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $learner_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false || $result->num_rows === 0) {
    die("Learner not found.");
}

$learner = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Learner Details</title>
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
<div style="margin-top: 100px; margin-bottom: -100px;"> <!-- Back Button -->
<button type="button" onclick="window.history.back();" class="registerbtn">Back</button></div>
  <!-- Update Learner Form -->
  <form action="update_learner.php" method="POST">
    <div class="addcontainer">
      <h1>Update Learner Details</h1>
      <hr>

      <!-- Learner ID (hidden input) -->
      <input type="hidden" name="learner_id" value="<?php echo $learner_id; ?>">

      <label for="name"><b>Name(s):</b></label>
      <input type="text" placeholder="Enter name" name="name" id="name" value="<?php echo htmlspecialchars($learner['name']); ?>" required>

      <label for="surname"><b>Surname:</b></label>
      <input type="text" placeholder="Enter surname" name="surname" id="surname" value="<?php echo htmlspecialchars($learner['surname']); ?>" required>

      <label for="id_number"><b>ID Number:</b></label>
      <input type="text" placeholder="Enter ID number" name="id_number" id="id_number" value="<?php echo htmlspecialchars($learner['id_number']); ?>" required>

      <label for="date_of_birth"><b>Date of Birth:</b></label>
      <input type="text" placeholder="YYYY/MM/DD" name="date_of_birth" id="date_of_birth" value="<?php echo htmlspecialchars($learner['date_of_birth']); ?>" required>

      <label for="gender"><b>Gender:</b></label>
      <input type="text" placeholder="Enter gender" name="gender" id="gender" value="<?php echo htmlspecialchars($learner['gender']); ?>" required>

      <label for="address"><b>Address:</b></label>
      <input type="text" placeholder="Enter physical address" name="address" id="address" value="<?php echo htmlspecialchars($learner['address']); ?>" required>

      <label for="grade"><b>Grade:</b></label>
      <input type="text" placeholder="Enter Grade" name="grade" id="grade" value="<?php echo htmlspecialchars($learner['grade']); ?>" required>

      <!-- Dropdown for subjects (single dropdown, allows multiple selection) -->
      <label for="subjects"><b>Select Subjects (up to 3):</b></label>
      <select id="subjects" name="subjects[]" multiple size="3" required>
          <option value="Mathematics">Mathematics</option>
          <option value="Science">Science</option>
          <option value="History">History</option>
          <option value="English">English</option>
          <option value="Geography">Geography</option>
          <option value="Art">Art</option>
          <option value="Music">Music</option>
          <option value="Physical Education">Physical Education</option>
          <option value="Computer Science">Computer Science</option>
          <option value="French">French</option>
          <option value="Spanish">Spanish</option>
          <option value="German">German</option>
          <option value="Biology">Biology</option>
          <option value="Chemistry">Chemistry</option>
          <option value="Physics">Physics</option>
      </select>
    </div>
    
    <hr>
    
   

    <!-- Submit Button -->
    <button type="submit" class="registerbtn">Update</button>
  </form>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
