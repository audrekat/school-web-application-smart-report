<?php
// Database connection parameters
$servername = "localhost"; // Change if needed
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "smart_report"; // Change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($term = 1; $term <= 4; $term++) {
        foreach ($_POST['results'] as $subject => $data) {
            $test1 = $data['test1'];
            $test2 = $data['test2'];
            $test3 = $data['test3'];
            $exam = $data['exam'];
            $level = $data['level'];
            $attendance = $_POST['attendance'][$term];
            $overall_results = $_POST['overall_results'][$term];
            $comments = $_POST['comments'][$term];

            $stmt = $conn->prepare("INSERT INTO results (term, subject, test1, test2, test3, exam, level, attendance, overall_results, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssssss", $term, $subject, $test1, $test2, $test3, $exam, $level, $attendance, $overall_results, $comments);
            $stmt->execute();
        }
    }
    echo "<script>alert('Results submitted successfully!');</script>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        .section-header {
            font-weight: bold;
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Teacher Dashboard</h1>
    <form action="" method="post">

        <!-- Term 1 Results Table -->
        <h2>Term 1 Results Table</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Test 1</th>
                <th>Test 2</th>
                <th>Test 3</th>
                <th>Exam</th>
                <th>Level</th>
            </tr>
            <tr>
                <td>Subject 1</td>
                <td><input type="text" name="results[Subject 1][test1]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][test2]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][test3]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][exam]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][level]" placeholder="Level"></td>
            </tr>
            <tr>
                <td>Subject 2</td>
                <td><input type="text" name="results[Subject 2][test1]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][test2]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][test3]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][exam]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][level]" placeholder="Level"></td>
            </tr>
            <tr>
                <td><strong>Attendance</strong></td>
                <td colspan="5"><input type="text" name="attendance[1]" placeholder="Attendance"></td>
            </tr>
            <tr>
                <td><strong>Results</strong></td>
                <td colspan="5"><input type="text" name="overall_results[1]" placeholder="Overall Results"></td>
            </tr>
            <tr>
                <td><strong>Comments</strong></td>
                <td colspan="5"><input type="text" name="comments[1]" placeholder="Comments"></td>
            </tr>
        </table>

        <!-- Repeat similar structure for Term 2, Term 3, and Term 4 -->
        <!-- Just update the term number accordingly -->
        
        <h2>Term 2 Results Table</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Test 1</th>
                <th>Test 2</th>
                <th>Test 3</th>
                <th>Exam</th>
                <th>Level</th>
            </tr>
            <tr>
                <td>Subject 1</td>
                <td><input type="text" name="results[Subject 1][test1]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][test2]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][test3]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][exam]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 1][level]" placeholder="Level"></td>
            </tr>
            <tr>
                <td>Subject 2</td>
                <td><input type="text" name="results[Subject 2][test1]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][test2]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][test3]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][exam]" placeholder="Result"></td>
                <td><input type="text" name="results[Subject 2][level]" placeholder="Level"></td>
            </tr>
            <tr>
                <td><strong>Attendance</strong></td>
                <td colspan="5"><input type="text" name="attendance[2]" placeholder="Attendance"></td>
            </tr>
            <tr>
                <td><strong>Results</strong></td>
                <td colspan="5"><input type="text" name="overall_results[2]" placeholder="Overall Results"></td>
            </tr>
            <tr>
                <td><strong>Comments</strong></td>
                <td colspan="5"><input type="text" name="comments[2]" placeholder="Comments"></td>
            </tr>
        </table>

        <!-- Add similar blocks for Term 3 and Term 4 -->

        <button type="submit">Submit Results</button>
    </form>
</body>
</html>
