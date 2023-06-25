<?php

include "connect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = '$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$user = array(
    'id' => $row['id'],
    'firstname' => $row['firstname'],
    'lastname' => $row['lastname'],
    'email' => $row['email'],
    'birthdate' => $row['birthdate'],
);

$response = array(
    'success' => true,
    'user' => $user
);

echo json_encode($response);

?>