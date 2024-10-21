<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $learner_id = $_POST['learner_id'];
    $learner_name = $_POST['learner_name'];
    $subjects = $_POST['subjects'];

    // Check if the number of subjects is 3 or less
    if (count($subjects) > 3) {
        die("You can only assign up to 3 subjects.");
    }

    // Database connection
    $dsn = 'mysql:host=your_host;dbname=your_db;charset=utf8';
    $username = 'your_username';
    $password = 'your_password';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the insert statement
        $stmt = $pdo->prepare("INSERT INTO Learner (learner_id, learner_name, subject_name) VALUES (:learner_id, :learner_name, :subject_name)");

        // Execute the statement for each subject
        foreach ($subjects as $subject) {
            $stmt->execute([
                ':learner_id' => $learner_id,
                ':learner_name' => $learner_name,
                ':subject_name' => $subject,
            ]);
        }

        echo "Subjects assigned successfully!";
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
