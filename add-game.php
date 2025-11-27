<?php
// add-game.php

// CRITICAL: Start the session to access the CAPTCHA code
session_start();

// --- CAPTCHA VALIDATION START ---
$captcha_input = $_POST['captcha_code'] ?? '';
$session_captcha = $_SESSION['captcha_code'] ?? '';

// Check if CAPTCHA input is empty or if it does not match the session code (case-insensitive)
if (empty($captcha_input) || strtolower($captcha_input) !== $session_captcha) {
    // CAPTCHA failed. Clear the session variable and redirect with an error.
    unset($_SESSION['captcha_code']); 
    header("Location: add-game-form.php?error=captcha_failed");
    exit();
}

// CAPTCHA passed. Clear the session variable so the code cannot be reused.
unset($_SESSION['captcha_code']);
// --- CAPTCHA VALIDATION END ---


// Set up variables for raw input (before escaping)
$game_name_raw = $_POST['GameName'] ?? '';
$game_description_raw = $_POST['GameDescription'] ?? '';
$game_released_date_raw = $_POST['DateReleased'] ?? '';
$game_rating_raw = $_POST['GameRating'] ?? '';


// Connect to database
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    error_log("Failed to connect to MySQL: " . $mysqli->connect_error);
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// 1. Escape all raw values to prevent SQL syntax errors and SQL injection.
// NOTE: Using prepared statements here would be superior, but we're keeping your original escape method.
$game_name = $mysqli->real_escape_string($game_name_raw);
$game_description = $mysqli->real_escape_string($game_description_raw);
$game_released_date = $mysqli->real_escape_string($game_released_date_raw);
$game_rating = $mysqli->real_escape_string($game_rating_raw);


// Build SQL statement using the safely escaped values
$sql = "INSERT INTO games (game_name, game_description, released_date, rating)
        VALUES ('{$game_name}', '{$game_description}', '{$game_released_date}', '{$game_rating}')";

// Run SQL statement
if (!$mysqli->query($sql)) {
    // If an error occurs, report it
    die("<h4>SQL error description: " . $mysqli->error . "</h4>");
}

// Redirect to list page on success
header("Location: games.php?status=added");
exit();

?>