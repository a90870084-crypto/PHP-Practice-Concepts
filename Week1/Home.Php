<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Week 1</title>
</head>
<body>

<?php
// 1. ECHO
echo "<h1>Welcome Aisha</h1>";

// 2. PRINT
print ("<h1>Aishayy</h1>");

// 3. DIFFERENCE BETWEEN ECHO AND PRINT
// Echo can display multiple arguments
echo "<h1>Ishaa wakan</h1>", "<h2>AISHA</h2>";

// Print can display only one argument
print "<p>Welcome to PHP</p>";


// 4. VARIABLES
$my_name = "Aisha";
$age = 20;
$course = "PHP";

echo "<p>My name is $my_name</p>";
echo "<p>My age is $age</p>";
echo "<p>My course is $course</p>";


// 5. VARIABLE RULES
// Rule 1: Variable must start with $
$name = "Aisha";

// Rule 2: Variable must start with a letter or underscore
$student = "Yonis";
$_subject = "PHP";

// Rule 3: Variable cannot start with a number
// $1name = "Aisha";  // This is NOT correct

// Rule 4: Variable names are case-sensitive
$Name = "Aisha";
$name2 = "Yonis";


// 6. SINGLE QUOTES
// With single quotes, $variable is not interpreted
echo 'My name is $my_name';

// With double quotes, the variable is interpreted
echo "<p>My name is $my_name</p>";


// 7. STRLEN()
// strlen() counts the number of characters
$my_str = "Welcome to PHP Republic";

echo "<p>Number of characters: " . strlen($my_str) . "</p>";

// 8. COUNT()
// count() counts the number of elements in an array
$students = ["Aisha", "Yonis", "Ali", "Hodan"];
echo "<p>Number of students: " . count($students) . "</p>";

// EXTRA: STR_WORD_COUNT()
// str_word_count() counts the number of words
echo "<p>Number of words: " . str_word_count($my_str) . "</p>";
?>
</body>
</html>