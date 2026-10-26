<?php
require_once 'functions.php';
if (isset($_POST['submitBtn'])) {
    $fullName = $_POST['fullName'];
    $accountNumber = $_POST['accountNumber'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $accountType = $_POST['accountType'];
    $openingBalance = $_POST['openingBalance'];
    $transactionType = isset($_POST['transactionType']) ? $_POST['transactionType'] : "";
    $transactionAmount = $_POST['transactionAmount'];
    $accountDuration = $_POST['accountDuration'];
    $hasError = false;
    $errorMessage = "";
    if (empty($fullName)) {
        $hasError = true;
        $errorMessage .= "Customer Full Name must not be empty.<br>";
    }
    if (empty($accountNumber)) {
        $hasError = true;
        $errorMessage .= "Account Number must not be empty.<br>";
    }
    if (empty($gender)) {
        $hasError = true;
        $errorMessage .= "Gender must be selected.<br>";
    }


    if (empty($accountType)) {
        $hasError = true;
        $errorMessage .= "Account Type must be selected.<br>";
    }

    if ($openingBalance < 0 || $openingBalance === "") {
        $hasError = true;
        $errorMessage .= "Opening Balance must be zero or greater.<br>";
    }
    if (empty($transactionType)) {
        $hasError = true;
        $errorMessage .= "Transaction Type must be selected.<br>";
    }

  
    if ($transactionAmount <= 0 || $transactionAmount === "") {
        $hasError = true;
        $errorMessage .= "Transaction Amount must be greater than zero.<br>";
    }

    if ($accountDuration < 0 || $accountDuration === "") {
        $hasError = true;
        $errorMessage .= "Account Duration must be a non-negative whole number.<br>";
    }

    $provisionalFee = 0;
    if ($transactionType == "Withdrawal") {
        if ($transactionAmount < 500) {
            $provisionalFee = 2;
        } else {
            $provisionalFee = 5;
        }
    }
    if ($transactionType == "Withdrawal") {
        $totalWithdrawalCost = $transactionAmount + $provisionalFee;
        if ($totalWithdrawalCost > $openingBalance) {
            $hasError = true;
            $errorMessage .= "Withdrawal Amount plus Transaction Fee exceeds available Opening Balance.<br>";
        }
    }

    
    if (empty($_FILES['idDocument']['name'])) {
        $hasError = true;
        $errorMessage .= "An identification document must be selected.<br>";
    }

    
    $fileName = "";
    $fileSize = 0;
    $fileType = "";
    $uploadStatus = "Failed";

    if (!$hasError) {
        $fileName = $_FILES['idDocument']['name'];
        $fileSize = $_FILES['idDocument']['size'];
        
        $fileType = $_FILES['idDocument']['type'];
        $fileTmpName = $_FILES['idDocument']['tmp_name'];

        
        if ($fileSize > 2097152) {
       
        $error.=" file size exceeds 2 MB .<br>";
        $uploadDir ="upload/";
        $uploadDirFile = $uploadDirFile .$fileName;


       

        if (file_exists($destination)) {
            $hasError = true;
            $errorMessage .= "A file with the same name already exists. Upload rejected to prevent overwriting.<br>";
        }

        if (!$hasError) {
            if (move_uploaded_file($fileTmpName, $destination)) {
                $uploadStatus = "Successful";
            } else {
                $hasError = true;
                $errorMessage .= "Error moving the uploaded file.<br>";
            }
        }
    }

    
    if ($hasError) {
        echo "<div style='color: red; font-family: Arial; padding: 20px;'>";
        echo "<h3>Validation / Upload Error(s):</h3>";
        echo $errorMessage;
        echo "<br><a href='index.html'>Back to Banking Form</a>";
        echo "</div>";
    } else {
        
        $transactionFee = calculateTransactionFee($transactionType, $transactionAmount);
        $totalCharges = calculateTotalCharges($transactionFee);
        $finalBalance = calculateFinalBalance($openingBalance, $transactionType, $transactionAmount, $totalCharges);
        $accountStatus = checkAccountStatus($finalBalance);

        // Interest Rate selection lookup for display string
        $interestRateDisplay = "";
        if ($accountType == "Savings") {
            $interestRateDisplay = "5%";
        } elseif ($accountType == "Current") {
            $interestRateDisplay = "2%";
        } elseif ($accountType == "Business") {
            $interestRateDisplay = "3%";
        }

        // Calculate Interest & Future Balance (Demonstrating default parameter if duration is 0 or matching requirement)
        if ($accountDuration == 0) {
            $calculatedInterest = calculateInterest($accountType, $finalBalance, 1); // Triggers default concept / 1 year standard
            $projectedFutureBalance = calculateFutureBalance($finalBalance, $calculatedInterest); // Uses default parameter = 1 inside function definition
        } else {
            $calculatedInterest = calculateInterest($accountType, $finalBalance, $accountDuration);
            $projectedFutureBalance = calculateFutureBalance($finalBalance, $calculatedInterest, $accountDuration);
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banking Transaction Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }
        .receipt-container {
            max-width: 700px;
            background: #ffffff;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
            width: 50%;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h2>Banking Transaction Receipt</h2>
    <table>
        <tr>
            <th>Banking Information</th>
            <th>Displayed Value</th>
        </tr>
        <tr>
            <td>Customer Full Name</td>
            <td><?php echo $fullName; ?></td>
        </tr>
        <tr>
            <td>Account Number</td>
            <td><?php echo $accountNumber; ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><?php echo $gender; ?></td>
        </tr>
        <tr>
            <td>Account Type</td>
            <td><?php echo $accountType; ?></td>
        </tr>
        <tr>
            <td>Opening Balance</td>
            <td>$<?php echo number_format($openingBalance, 2); ?></td>
        </tr>
        <tr>
            <td>Transaction Type</td>
            <td><?php echo $transactionType; ?></td>
        </tr>
        <tr>
            <td>Transaction Amount</td>
            <td>$<?php echo number_format($transactionAmount, 2); ?></td>
        </tr>
        <tr>
            <td>Transaction Fee</td>
            <td>$<?php echo number_format($transactionFee, 2); ?></td>
        </tr>
        <tr>
            <td>Total Banking Charges</td>
            <td>$<?php echo number_format($totalCharges, 2); ?></td>
        </tr>
        <tr>
            <td>Final Balance</td>
            <td>$<?php echo number_format($finalBalance, 2); ?></td>
        </tr>
        <tr>
            <td>Account Status</td>
            <td><?php echo $accountStatus; ?></td>
        </tr>
        <tr>
            <td>Account Duration</td>
            <td><?php echo $accountDuration; ?> Year(s)</td>
        </tr>
        <tr>
            <td>Interest Rate</td>
            <td><?php echo $interestRateDisplay; ?></td>
        </tr>
        <tr>
            <td>Calculated Interest</td>
            <td>$<?php echo number_format($calculatedInterest, 2); ?></td>
        </tr>
        <tr>
            <td>Projected Future Balance</td>
            <td>$<?php echo number_format($projectedFutureBalance, 2); ?></td>
        </tr>
        <tr>
            <td>Document Name</td>
            <td><?php echo $fileName; ?></td>
        </tr>
        <tr>
            <td>File Type</td>
            <td><?php echo $fileType; ?></td>
        </tr>
        <tr>
            <td>File Size</td>
            <td><?php echo $fileSize; ?> bytes</td>
        </tr>
        <tr>
            <td>Upload Status</td>
            <td><?php echo $uploadStatus; ?></td>
        </tr>
    </table>

    <a href="index.html" class="back-link">Back to Banking Form</a>
</div>

</body>
</html>

<?php
    }
}
?>