
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

// Create function
function sum($x, $y) {
    $z = $x + $y;
    echo $z;
}

// Calling function
sum(10, 20);

echo "<br>";

$a = 10;
$b = 20;

sum($a, $b);

echo "<br>";

function increase($number)
{
    //grating local variable
    $number += $number * 10;
}

$x = 5;

increase($x);

echo $x;

echo"<br>";

// Creating function
function sum1($number)
{
    // Creating local variable
    $number += 10;

    echo "Inside function: ";
    echo $number;
}

$x = 5;

// Calling function
sum1($x);

echo "<br>";

echo "Outside function: ";
echo $x;

echo"<br>";


// Creating global variable
$name = "welcome ca233";

echo $name;

echo "<br>";

// Creating function
function sum2()
{
    global $name;

    $name = "qali";
}

// Calling function
sum2();

// Print the changed value
echo $name;




function test()
{
    static $x = 0;

    $x++;

    echo $x."<br>";
}

test();
test();
test();






?>

</body>
</html>
