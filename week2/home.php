<!DOCTYPE html>
<html>
<head>
    <title>PHP Examples</title>
</head>
<body>

<?php

//creatin array -numeric array

//first way to create array
$names = array ();
//second way to intialize array
$names [0] ="ca233 is the best class";
$names [1] = 123;
echo $names[0] ,"<br>";
echo $names[1] ,"<br>";
// display the the arr
//display all the values usin pre tag
echo "<pre>";
print_r($names);
echo "</pre>";

//display all
echo "<br>";
echo "<pre>";
print_r($names);
echo "</pre>";

$info = array(
    "101",
    "aisha ahmed maxamud",
    20,
    "hodan district",
    "single"
);
echo"array values using for loop: <br>";
for($i=0; $i <count($info); $i++){
    echo $info [$i] . "<br>";
}

$ca233 = array(
    "id"=>"101",
    "name"=>"mohamed ali cabdi",
    "age"=>"20",
    "adress"=>"hodan district",
    "status"=>"single",
    "weigh"=>"160.5"
);
echo "<pre>";
echo "information about the person: <br>";
print_r($info);
var_dump($info);
echo"<pre>";
?>


</body>
</html>