<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
// Include the function file
require_once 'functions.php';

// Initialize error reporting container
$errors = [];
$successMessage = "";
$uploadStatus = "";

if (isset($_POST['register'])) {
    // Retrieve form data safely using trimming
    $fullName = trim($_POST['fullName'] ?? '');
    $employeeId = trim($_POST['employeeId'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $department = $_POST['department'] ?? '';
    $basicSalary = $_POST['basicSalary'] ?? '';
    $allowance = $_POST['allowance'] ?? '';
    $deduction = $_POST['deduction'] ?? '';

    // --- Validation Rules (Task 3) ---
    if (empty($fullName)) {
        $errors[] = "Employee Full Name must not be empty.";
    }

    if (empty($employeeId)) {
        $errors[] = "Employee ID must not be empty.";
    }

    if (empty($gender)) {
        $errors[] = "Gender must be selected.";
    }

    if (empty($department)) {
        $errors[] = "Department must be selected.";
    }

    if ($basicSalary === '' || $basicSalary <= 0) {
        $errors[] = "Basic Salary must be entered and greater than zero.";
    }

    if ($allowance === '' || $allowance < 0) {
        $errors[] = "Allowance must be entered and cannot be negative.";
    }

    if ($deduction === '' || $deduction < 0) {
        $errors[] = "Deduction must be entered and cannot be negative.";
    }

    // Calculations required prior to validation check for deductions exceeding gross + bonus
    $bSalary = floatval($basicSalary);
    $allow = floatval($allowance);
    $ded = floatval($deduction);

    $grossSalary = calculateGrossSalary($bSalary, $allow);
    $bonus = calculateBonus($bSalary);

    if ($ded > ($grossSalary + $bonus)) {
        $errors[] = "Deduction must not exceed Gross Salary plus Bonus.";
    }

    // Check if document input is present
    if (!isset($_FILES['employeeDoc']) || $_FILES['employeeDoc']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "An employee document must be selected.";
    }

    // --- Document Upload Logic (Task 4) ---
    $uploadDir = "uploads/";
    // Ensure uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = $_FILES['employeeDoc']['name'];
    $fileTmpName = $_FILES['employeeDoc']['tmp_name'];
    $fileSize = $_FILES['employeeDoc']['size'];
    $fileType = $_FILES['employeeDoc']['type'];
    $fileError = $_FILES['employeeDoc']['error'];

    $targetFilePath = $uploadDir . basename($fileName);

    if (empty($errors)) {
        // Check whether document was submitted successfully
        if ($fileError === UPLOAD_ERR_OK) {
            // Reject files larger than 2 MB (2 * 1024 * 1024 bytes)
            if ($fileSize > 2 * 1024 * 1024) {
                $errors[] = "Error: File size exceeds the maximum limit of 2 MB.";
            } 
            // Check whether a document with the same name already exists
            elseif (file_exists($targetFilePath)) {
                $errors[] = "Error: A document with the same name already exists. File upload rejected to prevent overwriting.";
            } 
            else {
                // Use move_uploaded_file() to save the document
                if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                    $uploadStatus = "Success";
                    $successMessage = "Document uploaded successfully.";
                } else {
                    $errors[] = "Error: Failed to move the uploaded file.";
                }
            }
        } else {
            $errors[] = "Error: There was an error during file uploading.";
        }
    }

    // If there are validation or upload errors, display them and stop execution
    if (!empty($errors)) {
        echo "<div style='color: red; font-family: Arial; padding: 20px;'>";
        echo "<h3>Validation/Upload Failures:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><br><a href='javascript:history.back()'>Go Back</a></div>";
        exit;
    }

    // --- Final Salary Calculations ---
    $netSalary = calculateNetSalary($grossSalary, $bonus, $ded);
    $salaryStatus = checkSalaryStatus($netSalary);
} else {
    // Redirect if accessed directly without form submission
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Results Summary</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .result-container { max-width: 700px; background: #fff; padding: 30px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        .success-msg { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; width: 40%; }
        td { background-color: #fdfdfd; }
        .back-btn { display: block; text-align: center; margin-top: 20px; text-decoration: none; background: #6c757d; color: white; padding: 10px; border-radius: 4px; }
        .back-btn:hover { background: #5a6268; }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Employee Information and Salary Results</h2>
    <div class="success-msg"><?php echo $successMessage; ?></div>

    <!-- Task 5: Display Employee Information and Salary Results in HTML Table -->
    <table>
        <tr>
            <th>Employee Full Name</th>
            <td><?php echo htmlspecialchars($fullName); ?></td>
        </tr>
        <tr>
            <th>Employee ID</th>
            <td><?php echo htmlspecialchars($employeeId); ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php echo htmlspecialchars($gender); ?></td>
        </tr>
        <tr>
            <th>Department</th>
            <td><?php echo htmlspecialchars($department); ?></td>
        </tr>
        <tr>
            <th>Basic Salary</th>
            <td><?php echo number_format($bSalary, 2); ?></td>
        </tr>
        <tr>
            <th>Allowance</th>
            <td><?php echo number_format($allow, 2); ?></td>
        </tr>
        <tr>
            <th>Gross Salary</th>
            <td><?php echo number_format($grossSalary, 2); ?></td>
        </tr>
        <tr>
            <th>Bonus</th>
            <td><?php echo number_format($bonus, 2); ?></td>
        </tr>
        <tr>
            <th>Deduction</th>
            <td><?php echo number_format($ded, 2); ?></td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td><?php echo number_format($netSalary, 2); ?></td>
        </tr>
        <tr>
            <th>Salary Status</th>
            <td><?php echo htmlspecialchars($salaryStatus); ?></td>
        </tr>
        <tr>
            <th>Uploaded Document Name</th>
            <td><?php echo htmlspecialchars($fileName); ?></td>
        </tr>
        <tr>
            <th>File Type</th>
            <td><?php echo htmlspecialchars($fileType); ?></td>
        </tr>
        <tr>
            <th>File Size</th>
            <td><?php echo round($fileSize / 1024, 2); ?> KB</td>
        </tr>
        <tr>
            <th>Upload Status</th>
            <td><?php echo htmlspecialchars($uploadStatus); ?></td>
        </tr>
    </table>

    <a href="index.html" class="back-btn">Register Another Employee</a>
</div>

</body>
</html>
</body>
</html>