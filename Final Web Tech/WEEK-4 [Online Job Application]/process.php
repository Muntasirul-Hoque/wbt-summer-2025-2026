<?php

// Check whether the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid Request!");
}

// Receive data using $_POST
$applicant_id = trim($_POST["applicant_id"] ?? "");
$name         = trim($_POST["name"] ?? "");
$email        = trim($_POST["email"] ?? "");
$phone        = trim($_POST["phone"] ?? "");
$password     = $_POST["password"] ?? "";
$gender       = $_POST["gender"] ?? "";
$job_position = $_POST["job_position"] ?? "";
$qualification = trim($_POST["qualification"] ?? "");
$address      = trim($_POST["address"] ?? "");

$errors = array();

// Applicant ID validation
if ($applicant_id == "") {
    $errors[] = "Applicant ID is required.";
}

// Name validation
if ($name == "") {
    $errors[] = "Name is required.";
}

// Email validation
if ($email == "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

// Phone validation - exactly 11 digits
if ($phone == "") {
    $errors[] = "Phone number is required.";
} elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
    $errors[] = "Phone number must contain exactly 11 digits.";
}

// Password validation
if ($password == "") {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors[] = "Password must contain at least 6 characters.";
}

// Gender validation
if ($gender == "") {
    $errors[] = "Please select your gender.";
}

// Job position validation
if ($job_position == "") {
    $errors[] = "Please select a job position.";
}

// Qualification validation
if ($qualification == "") {
    $errors[] = "Qualification is required.";
}

// Address validation
if ($address == "") {
    $errors[] = "Address is required.";
}


// =========================
// CV FILE VALIDATION
// =========================

if (!isset($_FILES["cv"]) || $_FILES["cv"]["error"] == UPLOAD_ERR_NO_FILE) {

    $errors[] = "Please upload your CV.";

} else {

    // Use $_FILES
    $cv = $_FILES["cv"];

    $file_name = $cv["name"];
    $file_size = $cv["size"];
    $tmp_name  = $cv["tmp_name"];
    $file_error = $cv["error"];

    // Get extension
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Allowed extensions
    $allowed_extensions = array("pdf", "doc", "docx");

    // Check extension
    if (!in_array($extension, $allowed_extensions)) {
        $errors[] = "Only PDF, DOC, and DOCX files are allowed.";
    }

    // Maximum 2 MB
    if ($file_size > 2 * 1024 * 1024) {
        $errors[] = "CV file size must not exceed 2 MB.";
    }

    if ($file_error != UPLOAD_ERR_OK) {
        $errors[] = "There was an error uploading the CV.";
    }
}


// =========================
// DISPLAY ERRORS
// =========================

if (!empty($errors)) {

    echo "<h2>Application Failed!</h2>";

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }

    echo '<br><a href="index.php">Go Back</a>';

    exit();
}


// =========================
// UPLOAD CV
// =========================

$upload_folder = "uploads/";

// Create folder if it doesn't exist
if (!is_dir($upload_folder)) {
    mkdir($upload_folder, 0777, true);
}

// Create a unique filename
$new_file_name = uniqid("CV_") . "_" . basename($file_name);

$destination = $upload_folder . $new_file_name;

// Move uploaded file
if (!move_uploaded_file($tmp_name, $destination)) {
    die("Failed to upload CV.");
}


// =========================
// $_GET PARAMETERS
// =========================

// Send Applicant ID, Name and CV filename to result.php

$url = "result.php?"
     . "id=" . urlencode($applicant_id)
     . "&name=" . urlencode($name)
     . "&cv=" . urlencode($new_file_name)
     . "&email=" . urlencode($email)
     . "&phone=" . urlencode($phone)
     . "&gender=" . urlencode($gender)
     . "&job=" . urlencode($job_position)
     . "&qualification=" . urlencode($qualification)
     . "&address=" . urlencode($address);

header("Location: " . $url);
exit();

?>