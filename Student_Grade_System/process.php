<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

require_once "functions.php";

// Get student information
$name = trim($_POST["student_name"] ?? "");
$id = trim($_POST["student_id"] ?? "");
$gender = $_POST["gender"] ?? "";
$faculty = $_POST["faculty"] ?? "";

$php = $_POST["php_mark"] ?? "";
$database = $_POST["database_mark"] ?? "";
$networking = $_POST["networking_mark"] ?? "";

// Validate student information
if (empty($name)) {
    die("Error: Student name is required.");
}

if (empty($id)) {
    die("Error: Student ID is required.");
}

if (empty($gender)) {
    die("Error: Please select gender.");
}

if (empty($faculty)) {
    die("Error: Please select faculty.");
}

if ($php === "" || $database === "" || $networking === "") {
    die("Error: Enter all three subject marks.");
}

// Validate marks
if (!is_numeric($php) || !is_numeric($database) ||
    !is_numeric($networking)) {
    die("Error: Marks must be numbers.");
}

if ($php < 0 || $php > 100 ||
    $database < 0 || $database > 100 ||
    $networking < 0 || $networking > 100) {
    die("Error: Marks must be between 0 and 100.");
}

// Calculate results
$total = calculateTotal($php, $database, $networking);
$average = calculateAverage($total);
$grade = calculateGrade($average);
$result = checkResult($average);

// Certificate upload
if (!isset($_FILES["certificate"])) {
    die("Error: Please select a certificate.");
}

$file = $_FILES["certificate"];

if ($file["error"] != 0) {
    die("Error: Certificate upload failed.");
}

if ($file["size"] > 2 * 1024 * 1024) {
    die("Error: Certificate must not exceed 2 MB.");
}

// Create uploads folder if it does not exist
if (!is_dir("uploads")) {
    mkdir("uploads");
}

// Get the original file name
$certificateName = basename($file["name"]);
$fileType = $file["type"];
$fileSize = round($file["size"] / 1024, 2);

// Check that the file has a name
if (empty($certificateName)) {
    die("Error: Please select a certificate.");
}

// Do not overwrite an existing file
if (file_exists("uploads/" . $certificateName)) {
    die("Error: A file with this name already exists.");
}

// Move uploaded file into uploads folder
if (move_uploaded_file(
    $file["tmp_name"],
    "uploads/" . $certificateName
)) {
    $uploadStatus = "Upload Successful";
} else {
    die("Error: Could not save the certificate.");
}

// Display results
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Results</title>
</head>
<body>

<h2>Student Examination Results</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Information</th>
        <th>Result</th>
    </tr>

    <tr>
        <td>Student Full Name</td>
        <td><?php echo htmlspecialchars($name); ?></td>
    </tr>

    <tr>
        <td>Student ID</td>
        <td><?php echo htmlspecialchars($id); ?></td>
    </tr>

    <tr>
        <td>Gender</td>
        <td><?php echo htmlspecialchars($gender); ?></td>
    </tr>

    <tr>
        <td>Faculty</td>
        <td><?php echo htmlspecialchars($faculty); ?></td>
    </tr>

    <tr>
        <td>PHP Mark</td>
        <td><?php echo $php; ?></td>
    </tr>

    <tr>
        <td>Database Mark</td>
        <td><?php echo $database; ?></td>
    </tr>

    <tr>
        <td>Networking Mark</td>
        <td><?php echo $networking; ?></td>
    </tr>

    <tr>
        <td>Total Marks</td>
        <td><?php echo $total; ?></td>
    </tr>

    <tr>
        <td>Average Marks</td>
        <td><?php echo number_format($average, 2); ?></td>
    </tr>

    <tr>
        <td>Grade</td>
        <td><?php echo $grade; ?></td>
    </tr>

    <tr>
        <td>Pass or Fail</td>
        <td><?php echo $result; ?></td>
    </tr>

    <tr>
        <td>Certificate Name</td>
        <td><?php echo htmlspecialchars($certificateName); ?></td>
    </tr>

    <tr>
        <td>File Type</td>
        <td><?php echo htmlspecialchars($fileType); ?></td>
    </tr>

    <tr>
        <td>File Size (KB)</td>
        <td><?php echo $fileSize; ?> KB</td>
    </tr>

    <tr>
        <td>Upload Status</td>
        <td><?php echo $uploadStatus; ?></td>
    </tr>
</table>

<br>
<a href="index.html">Back to Form</a>

</body>
</html>
</body>
</html>