<!DOCTYPE html>
<html>
<head>
    <title>Register Form</title>

    <style>

        form {
            width: 300px;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"],
        input[type="reset"] {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
        }

        input[type="reset"] {
            background-color: gray;
            color: white;
        }

    </style>
</head>

<body>

<h2>Register Form</h2>

<form method="POST" action="">

    <label>Enter Full Name</label> <input type="text" name="fullname">
    <label>Enter Password</label><input type="password" name="password">
    <label>Comment</label><textarea name="comment" cols="30" rows="6"></textarea>

    <label>Sex</label>
    <input type="radio" name="sex" value="male"> Male
    <input type="radio" name="sex" value="female"> Female

    <label>Choose Faculty</label>

    <input type="checkbox" name="Faculty[]" value="Engineering"> Engineering
    <br>

    <input type="checkbox" name="Faculty[]" value="Computer Science"> Computer Science
    <br>

    <input type="checkbox" name="Faculty[]" value="Multimedia"> Multimedia

    <br>

    <input type="reset" value="Reset Form">

    <input type="submit" name="register" value="Register">

</form>


<?php

if (isset($_POST['register'])) {

    // Textbox
    $fullname = $_POST['fullname'];

    // Password
    $password = $_POST['password'];

    // Textarea
    $comment = $_POST['comment'];

    echo "<h3>Register Information</h3>";

    echo "Full Name: " . $fullname . "<br>";

    echo "Password: " . $password . "<br>";

    echo "Comment: " . $comment . "<br>";

    // Radio Button
    if (!empty($_POST['sex'])) {

        echo "Sex: " . $_POST['sex'] . "<br>";

    } else {

        echo "Sex: Not Selected<br>";

    }

    // Checkbox
    if (!empty($_POST['Faculty'])) {

        echo "Faculty: ";

        foreach ($_POST['Faculty'] as $faculty) {

            echo $faculty . " ";

        }

        echo "<br>";

    } else {

        echo "Faculty: None Selected<br>";

    }

}

?>

</body>
</html>