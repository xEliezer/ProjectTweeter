<?php
// Include the database configuration file
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the tweet ID and user ID from the form
    $tweetId = $_POST['tweet_id'];
    $userId = $_POST['user_id'];

    // Check if the user owns the tweet
    $query = "SELECT user_id FROM tweets WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $tweetId);
    $stmt->execute();
    $stmt->bind_result($tweetUserId);
    $stmt->fetch();
    $stmt->close();

    if ($tweetUserId == $userId) {
        // Delete the tweet from the database
        $query = "DELETE FROM tweets WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $tweetId);

        if ($stmt->execute()) {
            echo "Tweet deleted successfully.";
        } else {
            echo "Error deleting tweet.";
        }
    } else {
        echo "You do not have permission to delete this tweet.";
    }
}
?>
