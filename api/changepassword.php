<?php
// Include the database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID and new password from the form
    $userId = $_POST['user_id'];
    $newPassword = $_POST['new_password'];

    // Validate the new password (you can add your own validation rules)
    if (strlen($newPassword) < 6) {
        echo "Password should be at least 6 characters long.";
    } else {
        // Update the user's password in the database
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si", password_hash($newPassword, PASSWORD_DEFAULT), $userId);

        if ($stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Error updating password.";
        }
    }
}
?>