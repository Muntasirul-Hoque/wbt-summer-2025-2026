<?php

// Get values using $_GET
$applicant_id = $_GET["id"] ?? "";
$name         = $_GET["name"] ?? "";
$cv_name      = $_GET["cv"] ?? "";

// Get at least two values using $_REQUEST
$email        = $_REQUEST["email"] ?? "";
$phone        = $_REQUEST["phone"] ?? "";
$gender       = $_REQUEST["gender"] ?? "";
$job_position = $_REQUEST["job"] ?? "";
$qualification = $_REQUEST["qualification"] ?? "";
$address      = $_REQUEST["address"] ?? "";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Successful</title>
</head>

<body>

<h2>=================================</h2>
<h2>       APPLICATION SUCCESSFUL</h2>
<h2>=================================</h2>

<p>
    <strong>Applicant ID:</strong>
    <?php echo htmlspecialchars($applicant_id); ?>
</p>

<p>
    <strong>Name:</strong>
    <?php echo htmlspecialchars($name); ?>
</p>

<p>
    <strong>Email:</strong>
    <?php echo htmlspecialchars($email); ?>
</p>

<p>
    <strong>Phone:</strong>
    <?php echo htmlspecialchars($phone); ?>
</p>

<p>
    <strong>Gender:</strong>
    <?php echo htmlspecialchars($gender); ?>
</p>

<p>
    <strong>Job Position:</strong>
    <?php echo htmlspecialchars($job_position); ?>
</p>

<p>
    <strong>Qualification:</strong>
    <?php echo htmlspecialchars($qualification); ?>
</p>

<p>
    <strong>Address:</strong>
    <?php echo htmlspecialchars($address); ?>
</p>

<p>
    <strong>Uploaded CV:</strong>
    <?php echo htmlspecialchars($cv_name); ?>
</p>

<p>
    <strong>Application submitted successfully.</strong>
</p>

</body>
</html>