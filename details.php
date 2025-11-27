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


<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($a_row['game_name']) ?></title>
<style>
body {
    font-family: "Consolas", "Orbitron", sans-serif;
    background: #0d0d0d; /* darker for neon pop */
    color: #f5f5f5;
    margin: 0;
    padding: 40px;
}

.container {
    background: #111; /* slightly lighter dark */
    max-width: 700px;
    margin: auto;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.3), 0 0 40px rgba(255, 0, 255, 0.2); /* neon glow */
    border: 1px solid #4dd0e1;
}

p {
    font-size: 1.1rem;
    line-height: 1.6rem;
    color: #f0f0f0;
    text-shadow: 0 0 3px #4dd0e1, 0 0 5px #ff5ec4; /* subtle neon glow on text */
}

a {
    display: inline-block;
    margin-top: 20px;
    color: #4dd0e1;
    text-decoration: none;
    font-weight: bold;
    text-shadow: 0 0 5px #4dd0e1, 0 0 10px #ff5ec4;
    transition: all 0.3s ease;
}

a:hover {
    color: #ff5ec4;
    text-shadow: 0 0 10px #ff5ec4, 0 0 20px #4dd0e1;
}

.back {
    text-align: center;
    margin-top: 20px;
    font-size: 1.05rem;
    color: #4dd0e1;
    text-shadow: 0 0 5px #4dd0e1, 0 0 10px #ff5ec4;
}
</style>

</head>
<body>
<div class="container">
<h1><?= htmlspecialchars($a_row['game_name']) ?></h1>
<p><?= htmlspecialchars($a_row['game_description']) ?></p>
<a class="back" href="games.php">&lt;&lt; Back to list</a>
</div>
</body>
</html>