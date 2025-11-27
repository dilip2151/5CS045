<?php
// Set up variables for raw input (before escaping)
$game_name_raw = $_POST['GameName'] ?? '';
$game_description_raw = $_POST['GameDescription'] ?? '';
$game_released_date_raw = $_POST['DateReleased'] ?? '';
$game_rating_raw = $_POST['GameRating'] ?? '';

// Connect to database
// Note: This connection logic is based on your provided data.
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    // Report connection failure gracefully
    error_log("Failed to connect to MySQL: " . $mysqli->connect_error);
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// --- FIX APPLIED HERE ---
// 1. Escape all raw values to prevent SQL syntax errors (like the one caused by an apostrophe 's) and SQL injection.
$game_name = $mysqli->real_escape_string($game_name_raw);
$game_description = $mysqli->real_escape_string($game_description_raw);
$game_released_date = $mysqli->real_escape_string($game_released_date_raw);
$game_rating = $mysqli->real_escape_string($game_rating_raw);
// --- END FIX ---

// Build SQL statement using the safely escaped values
$sql = "INSERT INTO games (game_name, game_description, released_date, rating)
        VALUES ('{$game_name}', '{$game_description}', '{$game_released_date}', '{$game_rating}')";

// Run SQL statement and report errors
if (!$mysqli->query($sql)) {
    // If an error occurs, report it
    echo("<h4>SQL error description: " . $mysqli->error . "</h4>");
    exit();
}

// Redirect to list (assuming the list page is 'games.php')
header("Location: games.php");
exit();
?>