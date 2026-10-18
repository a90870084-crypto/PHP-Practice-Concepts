<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Assignment 2 - Arrays</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #333; padding: 6px 12px; text-align: left; }
    th { background: #eee; }
</style>
</head>
<body>

<?php
//q1



$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);


echo "<b>Elements:</b> " . implode(", ", $numbers) . "<br>";


$total = 0;
$evenTotal = 0;
$oddTotal = 0;

foreach ($numbers as $n) {
    $total += $n;
    if ($n % 2 == 0) {
        $evenTotal += $n;
    } else {
        $oddTotal += $n;   
    }
}

echo "<b>Total  elements:</b> $total<br>";
echo "<b>Total of even elements:</b> $evenTotal<br>";
echo "<b>Total of odd elements:</b> $oddTotal<br>";

$min = min($numbers);
$minPositions = array_keys($numbers, $min);
echo "<b>Minimum element:</b> $min at position(s): " . implode(", ", $minPositions) . "<br>";

$max = max($numbers);
$maxPositions = array_keys($numbers, $max);
echo "<b>Maximum element:</b> $max at position(s): " . implode(", ", $maxPositions) . "<br>";
echo "<small>(Positions are counted from index 0)</small>";

//q2


$colors = array(
    "Light"  => array("Red" => "Light Red",  "Green" => "Light Green",  "Blue" => "Light Blue"),
    "Normal" => array("Red" => "Normal Red", "Green" => "Normal Green", "Blue" => "Normal Blue"),
    "Dark"   => array("Red" => "Dark Red",   "Green" => "Dark Green",   "Blue" => "Dark Blue")
);

echo "<table>";
echo "<tr><th></th><th>Red</th><th>Green</th><th>Blue</th></tr>";
foreach ($colors as $rowName => $row) {
    echo "<tr><th>$rowName</th>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

//q3



$students = array(
    "CA223" => array(
        "Name"    => "aisha axmed maxamud",
        "Phone"   => "0062XXXXXXX",
        "Address" => "maxamud xafiid, dharkenley"
    ),
    "CA222" => array(
        "Name"    => "ubax cilmi farrax",
        "Phone"   => "061XXXXXXX",
        "Address" => "buulo maxay, yaqshiid"
    ),
    "CA221" => array(
        "Name"    => "fatuma cabdi abshir",
        "Phone"   => "061XXXXXXX",
        "Address" => "buula xubey, wada jir"
    )
);

echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Phone</th><th>Address</th></tr>";
foreach ($students as $id => $info) {
    echo "<tr>";
    echo "<th>$id</th>";
    echo "<td>{$info['Name']}</td>";
    echo "<td>{$info['Phone']}</td>";
    echo "<td>{$info['Address']}</td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>