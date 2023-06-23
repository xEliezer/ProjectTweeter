<?php

include "config.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $email = $data['email'];
    $birthdate = $data['birthdate'];
    $password = $data['password'];

    // Check if the email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (firstname, lastname, birthdate, email, password) VALUES ('$firstname', '$lastname', '$birthdate', '$email', '$password')";
        if ($conn->query($sql)) {
            $response = array(
                'success' => true,
                'message' => 'Registration successful.'
            );
            echo json_encode($response);
        }

    } else {
        $response = array(
            'success' => false,
            'message' => 'Email already exists.'
        );
        echo json_encode($response);
    }

} else {
    echo "Invalid request! Only POST requests are allowed.";
}

?>