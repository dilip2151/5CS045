<h1>Search results</h1>
<?php
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Read value from form safely
$keywords = $_POST['keywords'] ?? '';
$keywords = $mysqli->real_escape_string($keywords);

// Run SQL query (backticks required for hyphenated column names)
$sql = "SELECT `game_ID`, `game_name`, `game_description`, `released_date`, `rating`
        FROM `games`
        WHERE `game_name` LIKE '%{$keywords}%'
        ORDER BY `released_date`";

$results = $mysqli->query($sql);

if (!$results) {
    echo "Query error: " . $mysqli->error;
    exit();
}

if ($results->num_rows === 0) {
    echo "<p>No games found.</p>";
} else {
    echo "<table border='1' cellpadding='5'>";
    while ($a_row = $results->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href=\"details.php?id=" . htmlspecialchars($a_row['game_ID']) . "\">"
             . htmlspecialchars($a_row['game_name']) . "</a></td>";
        echo "<td>" . htmlspecialchars($a_row['game_description']) . "</td>";

        echo "</tr>";
    }
    echo "</table>";
}
?>