<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get learner_id from the URL or request
$learner_id = isset($_GET['learner_id']) ? intval($_GET['learner_id']) : 14; 

if (!$learner_id) {
    die("Invalid learner ID.");
}

// Fetch learner information
$sql_learner = "SELECT name, surname, grade FROM learner WHERE learner_id = ?";
$stmt_learner = $conn->prepare($sql_learner);
$stmt_learner->bind_param("i", $learner_id);
$stmt_learner->execute();
$result_learner = $stmt_learner->get_result();

if ($result_learner->num_rows > 0) {
    $learner = $result_learner->fetch_assoc();
} else {
    die("Learner not found.");
}

// Fetch subjects, results, attendance, and comments
$sql_results = "
    SELECT s.subject_name, r.test1, r.test2, r.test3, r.exam, r.level, r.attendance, r.overall_results, r.comments
    FROM learner_subjects ls
    JOIN subject s ON ls.subject_id = s.subject_id
    JOIN results r ON ls.learner_subject_id = r.learner_subject_id
    WHERE ls.learner_id = ?";
$stmt_results = $conn->prepare($sql_results);
$stmt_results->bind_param("i", $learner_id);
$stmt_results->execute();
$results = $stmt_results->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report for <?php echo $learner['name'] . ' ' . $learner['surname']; ?></title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        td {
            background-color: #f4f4f4;
        }
        /* Responsive Table */
        @media (max-width: 600px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<h1>Report for <?php echo $learner['name'] . ' ' . $learner['surname']; ?></h1>
<h2>Grade: <?php echo $learner['grade']; ?></h2>

<!-- Display results table -->
<?php if ($results->num_rows > 0): ?>
    <table>
        <tr>
            <th>Subject</th>
            <th>Test 1</th>
            <th>Test 2</th>
            <th>Test 3</th>
            <th>Exam</th>
            <th>Level</th>
        </tr>

        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['subject_name']; ?></td>
                <td><?php echo $row['test1']; ?></td>
                <td><?php echo $row['test2']; ?></td>
                <td><?php echo $row['test3']; ?></td>
                <td><?php echo $row['exam']; ?></td>
                <td><?php echo $row['level']; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>

    <!-- Display attendance, overall results, and comments -->
    <h2>Attendance: <?php echo $row['attendance']; ?></h2>
    <h2>Overall Results: <?php echo $row['overall_results']; ?></h2>
    <h2>Comments: <?php echo $row['comments']; ?></h2>

<?php else: ?>
    <p>No results available for this learner.</p>
<?php endif; ?>

<!-- Back Button -->
<button onclick="window.history.back();">Back</button>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
