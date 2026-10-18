<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //creating Multidimensentional array

    $info = array(
        array(10,20, "CA233", 90.12),
        array("123", "aisha axmed", "CA233", 90.13)
    );

    //displa
    foreach($info as $list)
        echo $list[0], $list[1];

    //assignment to display information table
$students = array(
    array("aisha", 1990, "Hodan", "0608124390"),
    array("fatima", 2001, "Yaaqshiid", "0608124391"),
    array("ubax", 1986, "Shangaani", "0608124392")
);

echo "<table border='1'>";

echo "<tr>";
echo "<th>Name</th>";
echo "<th>Year of Birth</th>";
echo "<th>Address</th>";
echo "<th>Phone Number</th>";
echo "</tr>";

foreach ($students as $student) {
    echo "<tr>";

    echo "<td>" . $student[0] . "</td>";
    echo "<td>" . $student[1] . "</td>";
    echo "<td>" . $student[2] . "</td>";
    echo "<td>" . $student[3] . "</td>";

    echo "</tr>";
}

echo "</table>";
    ?>
</body>
</html>