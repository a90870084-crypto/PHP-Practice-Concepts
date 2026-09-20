<!DOCTYPE html>
<html>
<head>
    <title>PHP Examples</title>
</head>
<body>

<?php

// 1. CONSTANT
define("PI", 3.14);

echo "<h2>Constant</h2>";
echo "Value of PI is: ", PI;

echo "<hr>";

// 2. IF / ELSEIF / ELSE
$marks = 87;

echo "<h2>If / Elseif / Else</h2>";

if ($marks >= 90) {
    echo "Excellent";
}
elseif ($marks >= 80) {
    echo "Very good";
}
elseif ($marks >= 50) {
    echo "Minimal pass";
}
else {
    echo "Fail";
}

echo "<hr>";

// 3. SWITCH CASE
$day = 2;

echo "<h2>Switch Case</h2>";

switch ($day) {
    case 1:
        echo "Monday";
        break;

    case 2:
        echo "Tuesday";
        break;

    case 3:
        echo "Wednesday";
        break;

    case 4:
        echo "Thursday";
        break;

    case 5:
        echo "Friday";
        break;

    default:
        echo "Invalid day";
}

echo "<hr>";

// 4. FOR LOOP - Multiplication Table
echo "<h2>For Loop - 12 Times Table</h2>";

for ($count = 1; $count <= 12; ++$count) {
    echo "$count times 12 is " . ($count * 12) . "<br>";
}

echo "<hr>";

// 5. FOR LOOP - Numbers 1 to 15
echo "<h2>For Loop - Numbers 1 to 15</h2>";

for ($count = 1; $count <= 15; $count++) {
    echo "$count<br>";
}
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        echo "$i * $j = " . ($i * $j) . "<br>";
    }
}

echo "<br><hr><br>";

// HABKA 2: Row is 1, Column is 1, Result is 1 Format
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        echo "Row is $i, Column is $j, Result is " . ($i * $j) . "<br>";
    }
}

?>

</body>
</html>