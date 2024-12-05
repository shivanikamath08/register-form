<?php
// Retrieve form data
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$number = isset($_POST['number']) ? $_POST['number'] : '';

// Validate mandatory fields
if (empty($firstName) || empty($lastName) || empty($gender) || empty($email) || empty($password) || empty($number)) {
    die("All fields are required. Please go back and fill in the form completely.");
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test'); // Adjust credentials as necessary

// Check for connection error
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Preparation Failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);

// Execute the query
if ($stmt->execute()) {
    echo "Registration Successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
