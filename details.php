<?php
// Connect to database
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Grabs id value from URL safely
$id = $_GET['id'] ?? null;
$id = (int)$id; // cast to integer for safety

// Use backticks around column names with hyphens
$sql = "SELECT `game_ID`, `game_name`, `game_description` 
        FROM `games` 
        WHERE `game_ID` = {$id}";

$rst = $mysqli->query($sql);

if (!$rst) {
    echo "Query error: " . $mysqli->error;
    exit();
}

$a_row = $rst->fetch_assoc();

if (!$a_row) {
    echo "Game not found.";
    exit();
}
?>
<h1><?= htmlspecialchars($a_row['game_name']) ?></h1>
<p><?= htmlspecialchars($a_row['game_description']) ?></p>
<a href="games.php">&lt;&lt; Back to list</a>