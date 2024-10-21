<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'smart_report');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$surname = $_POST['surname'];
$id_number = $_POST['id_number'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$grade = $_POST['grade'];
$subjects = $_POST['subjects']; // Array of selected subjects
$parent_id = $_POST['parent_id'];
$password = $_POST['password'];

// Validate ID number
if (!preg_match('/^\d{13}$/', $id_number)) {
    die("Error: ID Number must be exactly 13 digits long.");
}

// Insert learner data into 'learners' table
$sql = "INSERT INTO learner (name, surname, id_number, date_of_birth, gender, address, grade) 
        VALUES ('$name', '$surname', '$id_number', '$date_of_birth', '$gender', '$address', '$grade')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted learner_id
    $learner_id = $conn->insert_id;

    // Insert subjects into 'learner_subjects' table
    foreach ($subjects as $subject) {
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
