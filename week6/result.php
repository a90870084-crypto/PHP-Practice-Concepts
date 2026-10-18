<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
session_start();
// Haddii aysan xog jirin, dib ugu celi foomka
if (!isset($_SESSION['student'])) {
    header("Location: index.php");
    exit();
}
$data = $_SESSION['student'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Natiijada Diiwaangelinta Ardayga</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h3>Xogta Ardayga La Diiwaangeliyey</h3>
        </div>
        <div class="card-body">
            
            <!-- Sawirka Ardayga -->
            <?php if (!empty($data['image'])): ?>
                <div class="text-center mb-4">
                    <img src="<?php echo $data['image']; ?>" alt="Sawirka Ardayga" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            <?php endif; ?>

            <!-- Miiska Xogta[span_8](start_span)[span_8](end_span) -->
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th colspan="2" class="text-center">Macluumaadka Shakhsiga ah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th style="width: 30%;">Magaca Buuxa</th><td><?php echo htmlspecialchars($data['name']); ?></td></tr>
                    <tr><th>Goobta Dhalashada (POB)</th><td><?php echo htmlspecialchars($data['pob']); ?></td></tr>
                    <tr><th>Taariikhda Dhalashada (DOB)</th><td><?php echo htmlspecialchars($data['dob']); ?></td></tr>
                    <tr><th>Jinsiga</th><td><?php echo htmlspecialchars($data['gender']); ?></td></tr>
                    <tr><th>Cinwaanka (Address)</th><td><?php echo htmlspecialchars($data['address']); ?></td></tr>
                    <tr><th>Telifoonka</th><td><?php echo htmlspecialchars($data['telephone']); ?></td></tr>
                    <tr><th>Email-ka</th><td><?php echo htmlspecialchars($data['email']); ?></td></tr>
                </tbody>

                <thead class="table-dark">
                    <tr>
                        <th colspan="2" class="text-center">Macluumaadka Waalidka</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th>Magaca Waalidka</th><td><?php echo htmlspecialchars($data['parent_name']); ?></td></tr>
                    <tr><th>Telifoonka Waalidka</th><td><?php echo htmlspecialchars($data['parent_tel']); ?></td></tr>
                    <tr><th>Xiriirka (Relationship)</th><td><?php echo htmlspecialchars($data['relationship']); ?></td></tr>
                </tbody>

                <thead class="table-dark">
                    <tr>
                        <th colspan="2" class="text-center">Macluumaadka Waxbarashada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><th>Lambarka Aqoonsiga (ID)</th><td><?php echo htmlspecialchars($data['student_id']); ?></td></tr>
                    <tr><th>Kulliyadda (Faculty)</th><td><?php echo htmlspecialchars($data['faculty']); ?></td></tr>
                    <tr><th>Waaxda (Department)</th><td><?php echo htmlspecialchars($data['department']); ?></td></tr>
                    <tr><th>Fasalka (Class)</th><td><?php echo htmlspecialchars($data['class']); ?></td></tr>
                    <tr><th>Taariikhda Diiwaangelinta</th><td><?php echo htmlspecialchars($data['reg_date']); ?></td></tr>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary">Ku Laabo Foomka</a>
            </div>

        </div>
    </div>
</div>
</body>
</html>