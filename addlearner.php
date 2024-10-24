<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'smart_report');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$id_number = trim($_POST['id_number']);
$date_of_birth = trim($_POST['dob']);
$gender = trim($_POST['gender'])  ? trim($_POST["gender"]) : '';
$address = trim($_POST['address']);
$grade = trim($_POST['grade']);
$subjects = trim($_POST['subjects']); // Array of selected subjects
$parent_id = trim($_POST['parent_id']);
$password = trim($_POST['password']);

// Validate ID number)
if (!preg_match('/^\d{13}$/', $id_number)) {
    die("Error: ID Number must be exactly 13 digits long.");
}

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



// Validate date of birth
   if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    } elseif (!DateTime::createFromFormat('Y-m-d', $dob)) {
        $errors[] = "Invalid date format.";
    } else {
        $dobDate = new DateTime($dob);
        $currentDate = new DateTime();

        // Check if the date is in the future
        if ($dobDate > $currentDate) {
            $errors[] = "Date of birth cannot be in the future.";
        }

        // Optionally, check if the user is at least 18 years old
        $age = $currentDate->diff($dobDate)->y;
        if ($age > 18) {
            $errors[] = "You must be at least younger than 18 years old.";
        }
    }

      // Validate gender
      if (empty($gender)) {
        $errors[] = "Gender is required.";
    }  
    
    // Validate address
    if (empty($address) || strlen($address) < 5 || strlen($address) > 100) {
        $errors[] = "Address must be between 5 and 100 characters.";
    }


 // Validate grade
 if (empty($grade) || !preg_match("/^(A|B|C|D|F|[0-9]{1,2}|100)$/i", $grade)) {
    $errors[] = "A valid grade is required. Please enter a letter grade (A-F) or a numeric grade (0-100).";
}






    // Check for errors
 if (empty($errors)) {
    // Process the data (e.g., save to database)
    echo "Form submitted successfully! Name: $name, Surname: $surname, Date_of_Birth: $dob, Gender: $, Address: $address, grade: $grade";
} else {
    foreach ($errors as $error) {
        echo "<p>Error: $error</p>";
    }
}









// Insert learner data into 'learners' table
$sql = "INSERT INTO learner (name, surname, id_number, date_of_birth, gender, address, grade) 
        VALUES ('$name', '$surname', '$id_number', '$date_of_birth', '$gender', '$address', '$grade')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted learner_id
    $learner_id = $conn->insert_id;

    // Insert subjects into 'learner_subjects' table
    foreach ($subject as $subject) {
        // Get the subject_id from the 'subjects' table
        $subject_sql = "SELECT subject_id FROM subject WHERE subject_name = '$subject'";
        $result = $conn->query($subject_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $subject_id = $row['subject_id'];

            // Insert into 'learner_subjects'
            $insert_subject_sql = "INSERT INTO learner_subjects (learner_id, subject_id) 
                                   VALUES ('$learner_id', '$subject_id')";
            $conn->query($insert_subject_sql);
        }
    }

    echo "Learner and subjects registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
