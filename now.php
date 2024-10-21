<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "smart_report");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get learner_id from the URL and validate it
$learner_id = isset($_GET['name']) ? intval($_GET['name']) : 1; 

if (!$learner_id) { // Check if learner_id is not set or is zero
    die("Invalid learner ID.");
}

// Fetch the learner_subject_id and corresponding subject_name
$sql = "SELECT ls.learner_subject_id, s.subject_name 
        FROM learner_subjects ls 
        JOIN subject s ON ls.subject_id = s.subject_id
        WHERE ls.learner_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $learner_id);
$stmt->execute();
$subject_result = $stmt->get_result();

if ($subject_result === false) {
    die("Error fetching results: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Add Results for Learner</title>
    <link rel="stylesheet" href="s">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header styles */
        .header {
            position: relative;
            top: 0;
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0056b3;
            color: white;
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .dashboard h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Main content styles */
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0056b3;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Input styles */
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Button styles */
        button {
            background-color: #0056b3;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Space above the button */
        }

        button:hover {
            background-color: #004494;
        }

        /* Back button styles */
        .back-button {
            background-color: #6c757d;
            margin-bottom: 20px; /* Space below the button */
        }

        .back-button:hover {
            background-color: #5a6268;
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

<!-- Main Container -->
<div class="container">
    <h1>Teacher Dashboard - Add Results for Learner #<?php echo $learner_id; ?></h1>

    <!-- Back Button -->
    <button class="back-button" onclick="window.history.back();">Back</button>

    <!-- Term 1 Results Table -->
    <h2>
        <label for="term">Term:</label>
        <select name="term" id="term" required>
            <option value="Term 1">Term 1</option>
            <option value="Term 2">Term 2</option>
            <option value="Term 3">Term 3</option>
            <option value="Exam">Exam</option>
        </select>
    </h2>
    <form action="" method="POST">
        <table>
            <tr>
                <th>Subject</th>
                <th>Test 1</th>
                <th>Test 2</th>
                <th>Test 3</th>
                <th>Exam</th>
                <th>Level</th>
            </tr>

            <?php
            if ($subject_result->num_rows > 0) {
                // Loop through each learner_subject and display input fields
                while ($row = $subject_result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['subject_name']}</td>
                            <td><input type='text' name='test1[{$row['learner_subject_id']}]' placeholder='Result'></td>
                            <td><input type='text' name='test2[{$row['learner_subject_id']}]' placeholder='Result'></td>
                            <td><input type='text' name='test3[{$row['learner_subject_id']}]' placeholder='Result'></td>
                            <td><input type='text' name='exam[{$row['learner_subject_id']}]' placeholder='Result'></td>
                            <td><input type='text' name='level[{$row['learner_subject_id']}]' placeholder='Level'></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No subjects available for this learner.</td></tr>";
            }
            ?>
            <!-- Additional fields for attendance, overall results, and comments -->
            <tr>
                <td><strong>Attendance</strong></td>
                <td colspan="5"><input type="text" name="attendance" placeholder="Attendance"></td>
            </tr>
            <tr>
                <td><strong>Overall Results</strong></td>
                <td colspan="5"><input type="text" name="overall_results" placeholder="Overall Results"></td>
            </tr>
            <tr>
                <td><strong>Comments</strong></td>
                <td colspan="5"><input type="text" name="comments" placeholder="Comments"></td>
            </tr>
        </table>

        <button type="submit">Submit Results</button>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
