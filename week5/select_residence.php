
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single and Multiple Choice</title>
</head>
<body>

    <h2>Single Choice</h2>

    <form method="post">

        <select name="single">
            <option value="">Choose Residence</option>
            <option value="Muqdisho">Muqdisho</option>
            <option value="bosaaso">bosaaso</option>
            <option value="Marko">Marko</option>
            <option value="kismayo">kismayo</option>
        </select><br><br>

        
        <input type="submit" name="submit1" value="Register">

    </form>

    <?php
    if (isset($_POST['submit1'])) {
        if (!empty($_POST['single'])) {
            echo $_POST['single'];
        } else {
            echo "Please choose a residence";
        }
    }
    ?>

    <br><br>

    <h2>Multiple Choice</h2>

    <form method="post">

        <select name="multiple[]" multiple size="5">
            <option value="" disabled>Choose Residence</option>
            <option value="Muqdisho">Muqdisho</option>
            <option value="bosaaso">bosaaso</option>
            <option value="Kismayo">Kismayo</option>
            <option value="Marko">Marko</option>
        </select><br><br>

        <input type="submit" name="submit2" value="Register">

    </form>

    <?php
    if (isset($_POST['submit2'])) {
        if (!empty($_POST['multiple'])) {
            foreach ($_POST['multiple'] as $r) {
                echo "$r, ";
            }
        } else {
            echo "Please choose a residence";
        }
    }
    ?>

</body>
</html>
