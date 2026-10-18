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
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Personal Information Validation
    $name = trim($_POST['name'] ?? '');
    $pob = trim($_POST['pob'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $telephone = trim($_POST['telephone'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Name validation: not empty and only letters and spaces[span_2](start_span)[span_2](end_span)
    if (empty($name)) {
        $errors['name'] = "Magaca waa khasab in la buuxiyo.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Magacu waa uu ka koobnaan karaa xarfaha iyo meelaha bannaan oo keliya.";
    }

    if (empty($pob)) $errors['pob'] = "Meesha dhalashada waa khasab.";
    if (empty($dob)) $errors['dob'] = "Taariikhda dhalashada waa khasab.";
    if (empty($address)) $errors['address'] = "Cinwaanku waa khasab.";
    if (empty($gender)) $errors['gender'] = "Jinsiga waa in la doortaa.";
    if (empty($telephone)) $errors['telephone'] = "Telifoonku waa khasab.";

    // Email validation[span_3](start_span)[span_3](end_span)
    if (empty($email)) {
        $errors['email'] = "Email-ku waa khasab.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Fadlan geli email sax ah.";
    }

    // 2. Parent Information Validation[span_4](start_span)[span_4](end_span)
    $parent_name = trim($_POST['parent_name'] ?? '');
    $parent_tel = trim($_POST['parent_tel'] ?? '');
    $relationship = trim($_POST['relationship'] ?? '');

    if (empty($parent_name)) $errors['parent_name'] = "Magaca waalidka waa khasab.";
    if (empty($parent_tel)) $errors['parent_tel'] = "Telifoonka waalidka waa khasab.";
    if (empty($relationship)) $errors['relationship'] = "Xiriirka waalidka waa khasab.";

    // 3. Academic Information Validation[span_5](start_span)[span_5](end_span)
    $student_id = trim($_POST['student_id'] ?? '');
    $faculty = trim($_POST['faculty'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $class = trim($_POST['class'] ?? '');
    $reg_date = $_POST['reg_date'] ?? '';

    if (empty($student_id)) $errors['student_id'] = "Aqoonsiga (ID) waa khasab.";
    if (empty($faculty)) $errors['faculty'] = "Kulliyaddu waa khasab.";
    if (empty($department)) $errors['department'] = "Waaxdu waa khasab.";
    if (empty($class)) $errors['class'] = "Fasalku waa khasab.";
    if (empty($reg_date)) $errors['reg_date'] = "Taariikhda diiwaangelinta waa khasab.";

    // 4. Image Upload Validation[span_6](start_span)[span_6](end_span)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        $file_type = $_FILES['image']['type'];

        if (!in_array($file_type, $allowed_types)) {
            $errors['image'] = "Fadlan soo geli sawir noociisu yahay .png, .jpg, .jpeg, ama .gif ah oo keliya.";
        } else {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $image_name = time() . "_" . basename($_FILES['image']['name']);
            $target_file = $upload_dir . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }
    } else {
        $errors['image'] = "Sawirka ardayga waa khasab in la soo geliyo.";
    }

    // Haddii aysan jirin wax qalad ah (Errors), keydi xogta oo u gudub bogga xiga[span_7](start_span)[span_7](end_span)
    if (empty($errors)) {
        $_SESSION['student'] = [
            'name' => $name,
            'pob' => $pob,
            'dob' => $dob,
            'address' => $address,
            'gender' => $gender,
            'telephone' => $telephone,
            'email' => $email,
            'parent_name' => $parent_name,
            'parent_tel' => $parent_tel,
            'relationship' => $relationship,
            'student_id' => $student_id,
            'faculty' => $faculty,
            'department' => $department,
            'class' => $class,
            'reg_date' => $reg_date,
            'image' => $target_file ?? ''
        ];
        header("Location: result.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diiwaangelinta Ardayda - Jamhuriya University</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3>Foomka Diiwaangelinta Ardayda</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                
                <!-- Qeybta 1: Macluumaadka Shakhsiga ah -->
                <h4 class="text-secondary border-bottom pb-2 mb-3">1. Macluumaadka Shakhsiga ah</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Magaca Buuxa:</label>
                        <input type="text" name="name" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['name'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['name'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Goobta Dhalashada (POB):</label>
                        <input type="text" name="pob" class="form-control <?php echo isset($errors['pob']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['pob'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['pob'] ?? ''; ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Taariikhda Dhalashada (DOB):</label>
                        <input type="date" name="dob" class="form-control <?php echo isset($errors['dob']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['dob'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['dob'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jinsiga:</label>
                        <select name="gender" class="form-select <?php echo isset($errors['gender']) ? 'is-invalid' : ''; ?>">
                            <option value="">Dooro Jinsiga</option>
                            <option value="Lab" <?php echo (($_POST['gender'] ?? '') == 'Lab') ? 'selected' : ''; ?>>Lab</option>
                            <option value="Dheddig" <?php echo (($_POST['gender'] ?? '') == 'Dheddig') ? 'selected' : ''; ?>>Dheddig</option>
                        </select>
                        <div class="invalid-feedback"><?php echo $errors['gender'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cinwaanka (Address):</label>
                        <input type="text" name="address" class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['address'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['address'] ?? ''; ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Telifoonka:</label>
                        <input type="text" name="telephone" class="form-control <?php echo isset($errors['telephone']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['telephone'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['telephone'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email-ka:</label>
                        <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['email'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['email'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sawirka Ardayga:</label>
                        <input type="file" name="image" class="form-control <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['image'] ?? ''; ?></div>
                    </div>
                </div>

                <!-- Qeybta 2: Macluumaadka Waalidka -->
                <h4 class="text-secondary border-bottom pb-2 my-4">2. Macluumaadka Waalidka</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Magaca Waalidka / Masuulka:</label>
                        <input type="text" name="parent_name" class="form-control <?php echo isset($errors['parent_name']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['parent_name'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['parent_name'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Telifoonka Waalidka:</label>
                        <input type="text" name="parent_tel" class="form-control <?php echo isset($errors['parent_tel']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['parent_tel'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['parent_tel'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Xiriirka uu la leeyahay (Relationship):</label>
                        <input type="text" name="relationship" class="form-control <?php echo isset($errors['relationship']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['relationship'] ?? ''; ?>" placeholder="Tusaale: Aabe / Hooyo">
                        <div class="invalid-feedback"><?php echo $errors['relationship'] ?? ''; ?></div>
                    </div>
                </div>

                <!-- Qeybta 3: Macluumaadka Waxbarashada -->
                <h4 class="text-secondary border-bottom pb-2 my-4">3. Macluumaadka Waxbarashada</h4>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Lambarka Aqoonsiga (ID):</label>
                        <input type="text" name="student_id" class="form-control <?php echo isset($errors['student_id']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['student_id'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['student_id'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kulliyadda (Faculty):</label>
                        <input type="text" name="faculty" class="form-control <?php echo isset($errors['faculty']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['faculty'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['faculty'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Waaxda (Department):</label>
                        <input type="text" name="department" class="form-control <?php echo isset($errors['department']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['department'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['department'] ?? ''; ?></div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Fasalka (Class):</label>
                        <input type="text" name="class" class="form-control <?php echo isset($errors['class']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['class'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['class'] ?? ''; ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Taariikhda Diiwaangelinta:</label>
                        <input type="date" name="reg_date" class="form-control <?php echo isset($errors['reg_date']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['reg_date'] ?? ''; ?>">
                        <div class="invalid-feedback"><?php echo $errors['reg_date'] ?? ''; ?></div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5">Diiwaangeli (Register)</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>