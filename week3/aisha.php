<!DOCTYPE html>
<html>
<head>
    <title>PHP Examples</title>
</head>
<body>
<?php
// 1. Greatest and Smallest Number
$a = 25;
$b = 10;
$c = 18;

if ($a >= $b && $a >= $c) {
    $greatest = $a;
} elseif ($b >= $a && $b >= $c) {
    $greatest = $b;
} else {
    $greatest = $c;
}

if ($a <= $b && $a <= $c) {
    $smallest = $a;
} elseif ($b <= $a && $b <= $c) {
    $smallest = $b;
} else {
    $smallest = $c;
}

echo "1. Greatest number: " . $greatest . "<br>";
echo "Smallest number: " . $smallest . "<br><br>";
// 2. Divisible by 3 and 5

$num = 15;

echo "2. ";

if ($num % 3 == 0 && $num % 5 == 0) {
    echo "The number is divisible by both 3 and 5.";
} elseif ($num % 3 == 0) {
    echo "The number is divisible by 3.";
} elseif ($num % 5 == 0) {
    echo "The number is divisible by 5.";
} else {
    echo "The number is divisible by neither 3 nor 5.";
}

echo "<br><br>";
// 3. Odd numbers 2 to 20
//    Even numbers 35 to 7
echo "3. Odd numbers from 2 to 20:<br>";

for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo $i . " ";
    }
}

echo "<br><br>";

echo "Even numbers from 35 to 7:<br>";

for ($i = 35; $i >= 7; $i--) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
}

echo "<br><br>";
// 4. Divisible by 2 and 5
//    From 50 to 2

echo "4. Numbers divisible by both 2 and 5:<br>";

for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo $i . " ";
    }
}

echo "<br><br>";
// 5. Reverse a number

$num = 12345;
$reverse = 0;

while ($num > 0) {
    $digit = $num % 10;
    $reverse = ($reverse * 10) + $digit;
    $num = (int)($num / 10);
}

echo "5. Reverse number: " . $reverse;

echo "<br><br>";
// 6. LCM of two numbers
$a = 8;
$b = 12;

if ($a > $b) {
    $lcm = $a;
} else {
    $lcm = $b;
}

while (true) {
    if ($lcm % $a == 0 && $lcm % $b == 0) {
        break;
    }

    $lcm++;
}

echo "6. LCM of $a and $b = " . $lcm;

?>

</body>
</html>
