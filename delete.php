<?php
// Set up variable for raw input (before escaping)
$game_id_raw = $_GET['id'] ?? '';

// Validate ID input
if ($game_id_raw === '' || !is_numeric($game_id_raw)) {
    // If no valid ID is provided, redirect back to the main page
    header("Location: index.php?error=invalid_id");
    exit();
}

// Connect to database
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    // Report connection failure gracefully
    error_log("Failed to connect to MySQL: " . $mysqli->connect_error);
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// --- FIX APPLIED HERE ---
// Escape the raw ID to prevent SQL injection
$game_id = (int)$mysqli->real_escape_string($game_id_raw);
// --- END FIX ---

// Build SQL statement using the safely escaped value
$sql = "DELETE FROM games WHERE game_ID = {$game_id}";

// Run SQL statement and report errors
if (!$mysqli->query($sql)) {
    // If an error occurs, report it
    echo("<h4>SQL error description: " . $mysqli->error . "</h4>");
    exit();
}

// Redirect to list (assuming the list page is 'games.php')
header("Location: games.php?status=deleted");
exit();
?>