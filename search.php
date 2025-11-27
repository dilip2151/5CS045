<?php
// CRITICAL: Database credentials should ideally be in a separate, secure config file
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    echo "<h1>Database Connection Error</h1>";
    echo "<p>Could not connect to the database. Please try again later.</p>";
    error_log("MySQL connection failed: " . $mysqli->connect_error);
    exit();
}

// Read value from form safely
$keywords = $_POST['keywords'] ?? '';

// --- SECURITY FIX: Using Prepared Statements for safe searching ---
$sql = "SELECT `game_ID`, `game_name`
        FROM `games`
        WHERE `game_name` LIKE ?
        ORDER BY `released_date`";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    echo "Query preparation failed. Please contact support.";
    error_log("SQL Prepare Error: " . $mysqli->error);
    exit();
}

$search_param = '%' . $keywords . '%';

$stmt->bind_param("s", $search_param);

$stmt->execute();

$results = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results for "<?= htmlspecialchars($keywords) ?>"</title>
<style>
/* --- STYLES COPIED FROM details.php FOR CONSISTENT LOOK --- */
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
    /* Kept for potential use, though not strictly needed here */
    text-align: center;
    margin-top: 20px;
    font-size: 1.05rem;
    color: #4dd0e1;
    text-shadow: 0 0 5px #4dd0e1, 0 0 10px #ff5ec4;
}

/* Custom styles for the table */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #4dd0e1; /* Neon border for table cells */
    color: #f5f5f5;
}

th {
    background: #2a2a2a;
    color: #00ffff; /* Brighter neon blue for headers */
    text-shadow: 0 0 8px #00ffff;
}

/* Ensure links in table cells also follow the style */
td a {
    display: block; /* Make the link fill the cell */
    padding: 0;
    margin: 0;
}
</style>

</head>
<body>
<div class="container">
    <h1>Search Results</h1>

<?php
if ($results->num_rows === 0) {
    echo "<p>No games found matching '<strong>" . htmlspecialchars($keywords) . "</strong>'.</p>";
} else {
        
    // Output table with only the Game Name column
    echo "<table border='1' cellpadding='5'>";
    echo "<thead>";
    echo "<tr><th>Game Name</th></tr>"; 
    echo "</thead>";
    echo "<tbody>";

    while ($a_row = $results->fetch_assoc()) {
        echo "<tr>";
        
        // Display the linked game name column
        echo "<td><a href=\"details.php?id=" . htmlspecialchars($a_row['game_ID']) . "\">"
             . htmlspecialchars($a_row['game_name']) . "</a></td>";
        
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
}

$stmt->close();
$mysqli->close();
?>

    <p class="back"><a href="games.php">&lt;&lt; Back to search</a></p>
</div>
</body>
</html>