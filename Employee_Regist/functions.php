<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

function calculateGrossSalary($basicSalary, $allowance) {
    return $basicSalary + $allowance;
}

function calculateNetSalary($grossSalary, $bonus, $deduction) {
    return $grossSalary + $bonus - $deduction;
}

function calculateBonus($basicSalary) {
    if ($basicSalary >= 1000) {
        return $basicSalary * 0.10; // 10% bonus
    } elseif ($basicSalary >= 500 && $basicSalary <= 999.99) {
        return $basicSalary * 0.05; // 5% bonus
    } else {
        return 0; // No bonus
    }
}


function checkSalaryStatus($netSalary) {
    if ($netSalary >= 1500) {
        return "High Salary";
    } elseif ($netSalary >= 800 && $netSalary <= 1499.99) {
        return "Medium Salary";
    } else {
        return "Low Salary";
    }
}
?>
</body>
</html>