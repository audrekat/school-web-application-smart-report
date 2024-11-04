<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name =  trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $id_number = trim($_POST['id_number']);
    $gender = trim($_POST['gender'])  ? trim($_POST["gender"]) : '';
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Consider hashing this
    $user_type = trim($_POST['user_type'])  ? trim($_POST["user_type"]) : ''; // Missing semicolon was added

    // Validate name
 if (empty($name)) {
    $errors[] = "Name is required.";
} elseif (!preg_match("/^[A-Za-z]+$/", $name)) {
    $errors[] = "Name can only contain letters.";
}

// Validate surname
if (empty($surname)) {
    $errors[] = "Name is required.";
 } elseif (!preg_match("/^[A-Za-z]+$/", $surname)) {
     $errors[] = "Surname can only contain letters.";
 }

   // Validate ID number
   if (!preg_match('/^\d{13}$/', $id_number)) {
    die("Error: ID Number must be exactly 13 digits long.");
}

  // Validate gender
  if (empty($gender)) {
    $errors[] = "Gender is required.";
}  

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Validate address
if (empty($address) || strlen($address) < 5 || strlen($address) > 100) {
    $errors[] = "Address must be between 5 and 100 characters.";
}
 // Validate contact number
 if (empty($contact) || !preg_match("/^\+27[0-9]{9}$/", $contact)) {
    $errors[] = "Contact number must be in the format +27XXXXXXXXX.";

 }

 // Validate username
if (empty($username) || !preg_match("/^[A-Za-z0-9_]{3,15}$/", $username)) {
    $errors[] = "Username must be 3-15 characters and can include letters, numbers, and underscores.";
}

// Validate password
if (empty($password) || strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
} elseif (!preg_match("/[A-Z]/", $password)) {
    $errors[] = "Password must contain at least one uppercase letter.";
} elseif (!preg_match("/[a-z]/", $password)) {
    $errors[] = "Password must contain at least one lowercase letter.";
} elseif (!preg_match("/[0-9]/", $password)) {
    $errors[] = "Password must contain at least one number.";
} elseif (!preg_match("/[\W_]/", $password)) {
    $errors[] = "Password must contain at least one special character.";
}

// Confirm password
if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}

 // Validate user type
 if (empty($user_type) || !in_array($user_type, ['admin', 'teacher', 'parent'])) {
    $errors[] = "Please select a valid user type.";
}


 // Check for errors
 if (empty($errors)) {
    echo "Form submitted successfully! Name: $name, Surname: $surname, ID number: $id_number, Gender: $gender,  Email: $email, Address: $address, Contact: $contact,";
} else {
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}










    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "smart-report");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to insert the data
    $sql = "INSERT INTO teacher (name, surname, id_number, gender, email, contact, username, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $stmt->bind_param("sssssssss", $name, $surname, $id_number, $gender, $email, $contact, $username, $hashed_password, $user_type);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $success_message = "Teacher registered successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register a Teacher</title>
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
          <h1>Register a Teacher</h1>
          
          <!-- Display success or error messages -->
          <?php if (isset($success_message)) { echo "<p style='color:green;'>$success_message</p>"; } ?>
          <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
        
          <hr>
      
          <label for="name"><b>Name(s):</b></label>
          <input type="text" placeholder="Enter name" name="name" id="name" required pattern="[A-Za-z]+" title="Only letters are allowed.">
    
          <label for="surname"><b>Surname:</b></label>
          <input type="text" placeholder="Enter surname" name="surname" id="surname" required  pattern="[A-Za-z]+" title="Only letters are allowed.">
    
          <label for="id_number"><b>ID Number:</b></label>
          <input type="text" placeholder="Enter ID number" name="id_number" id="id_number" required minlength="8" title="Password must be at least 8 characters long.">

          <label for="gender"><b>Gender:</b></label>
          <select name="gender" id="gender" required>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
          </select>

          <label for="email"><b>Email Address:</b></label>
          <input type="email" placeholder="Enter Email address" name="email" id="email" required title="Please enter a valid email address." >
    
          <label for="contact"><b>Contact:</b></label>
          <input type="tel" id="contact" name="contact" required pattern="\+27[0-9]{9}" title="Format: +27XXXXXXXXX">
          
          <label for="username"><b>Username:</b></label>
          <input type="text" placeholder="Enter username" name="username" id="username" required>

          <label for="password"><b>Password:</b></label>
          <input type="password" placeholder="Enter password" name="password" id="password" required>

          <label for="confirm_password">Confirm Password:</label>
          <input type="password" id="confirm_password" name="confirm_password" required title="Please confirm your password.">

          <label for="user_type"><b>User Type:</b></label>
          <select name="user_type" id="user_type" required>
            <option value="teacher">Teacher</option>
            <option value="admin">Admin</option>
            <option value="parent">parent</option>
          </select>

          <hr>
          <button type="submit" class="registerbtn">Register</button>
        </div>
    </form>
</body>
</html>
