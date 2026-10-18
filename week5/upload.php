<!DOCTYPE html>
<html>
<head>
    <title>Upload Files in PHP</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select Your file to upload:
    <hr>
    <input type="file" name="scertificate" required>
    <hr>
    <input type="submit" name="submit" value="Upload File">
</form>

<?php

if (isset($_POST['submit'])) {

    if (!empty($_FILES['scertificate']['name'])) {

        echo "File Name: " . $_FILES['scertificate']['name'] . "<br>";
        echo "File Size: " . $_FILES['scertificate']['size'] . "<br>";
        echo "Temporary Name: " . $_FILES['scertificate']['tmp_name'] . "<br>";
        echo "File Type: " . $_FILES['scertificate']['type'] . "<br>";

        $folder = "C:\Users\hp\Downloads\move files";
 
        if (!is_dir($folder)) {
            mkdir($folder, 0775, true);
        }
        $temp = $_FILES['scertificate']['tmp_name'];
        $destination = $folder . basename($_FILES['scertificate']['name']);

        if (move_uploaded_file($temp, $destination)) {
            echo "<br>File has been uploaded successfully.";
        } else {
            echo "<br>Failed to upload the file.";
        }

    } else {
        echo "No file is selected.";
    }
}
?>

</body>
</html>