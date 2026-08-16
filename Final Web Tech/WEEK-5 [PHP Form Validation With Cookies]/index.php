<?php

// Variables
$name = "";
$student_id = "";
$email = "";
$department = "";

$errors = [];
$message = "";

// -----------------------------
// Clear Cookies
// -----------------------------
if (isset($_POST['clear_cookie'])) {

    setcookie("student_name", "", time() - 3600, "/");
    setcookie("student_id", "", time() - 3600, "/");

    $message = "Cookie deleted successfully.";
}

// -----------------------------
// Form Submission
// -----------------------------
if (isset($_POST['submit'])) {

    $name = trim($_POST['student_name']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $department = $_POST['department'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Student Name Validation
    if (empty($name)) {
        $errors[] = "Student Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors[] = "Student Name should contain only letters and spaces.";
    }

    // Student ID Validation
    if (empty($student_id)) {
        $errors[] = "Student ID is required.";
    } elseif (strlen($student_id) < 4) {
        $errors[] = "Student ID must contain at least 4 characters.";
    }

    // Email Validation
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Department Validation
    if (empty($department)) {
        $errors[] = "Please select a department.";
    }

    // Password Validation
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must contain at least 6 characters.";
    }

    // Confirm Password
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // -----------------------------
    // If validation successful
    // -----------------------------
    if (empty($errors)) {

        // Cookies will remain for 1 hour
        setcookie("student_name", $name, time() + 3600, "/");
        setcookie("student_id", $student_id, time() + 3600, "/");

        $message = "Registration successful!";
    }
}

// -----------------------------
// Check Existing Cookies
// -----------------------------
$cookie_name = isset($_COOKIE['student_name']) ? $_COOKIE['student_name'] : "";
$cookie_id = isset($_COOKIE['student_id']) ? $_COOKIE['student_id'] : "";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>

                     
</head>

<body>

<div class="container">

    <h2>Student Registration Form</h2>

    <?php if (!empty($cookie_name) && !empty($cookie_id)): ?>

        <div class="welcome">
            <h3>Welcome Back!</h3>
            <p><strong>Student Name:</strong>
                <?php echo htmlspecialchars($cookie_name); ?>
            </p>

            <p><strong>Student ID:</strong>
                <?php echo htmlspecialchars($cookie_id); ?>
            </p>
        </div>

    <?php else: ?>

        <p>No saved student information found.</p>

    <?php endif; ?>


    <?php if (!empty($errors)): ?>

        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>


    <?php if (!empty($message)): ?>

        <p class="success">
            <?php echo $message; ?>
        </p>

    <?php endif; ?>


    <form method="POST" action="">

        <label>Student Name</label>
        <input type="text"
               name="student_name"
               value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label>Student ID</label>
        <input type="text"
               name="student_id"
               value="<?php echo htmlspecialchars($student_id); ?>"><br><br>

        <label>Email</label>
        <input type="text"
               name="email"
               value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label>Department</label>

        <select name="department">

            <option value="">-- Select Department --</option>

            <option value="CSE"
                <?php if ($department == "CSE") echo "selected"; ?>>
                CSE
            </option>

            <option value="EEE"
                <?php if ($department == "EEE") echo "selected"; ?>>
                EEE
            </option>

            <option value="BBA"
                <?php if ($department == "BBA") echo "selected"; ?>>
                BBA
            </option>

            <option value="Architecture"
                <?php if ($department == "Architecture") echo "selected"; ?>>
                Architecture
            </option>

        </select><br><br>


        <label>Password</label>
        <input type="password" name="password"><br><br>


        <label>Confirm Password</label>
        <input type="password" name="confirm_password"><br><br>


        <button type="submit"
                name="submit"
                class="submit">
            Register
        </button>

        <button type="submit"
                name="clear_cookie"
                class="clear">
            Clear Cookie
        </button>

    </form>

</div>

</body>
</html>