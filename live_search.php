<?php
// live_search.php - Returns only HTML table rows for Ajax

// 1. Database Connection (Use your existing credentials)
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

if ($mysqli->connect_errno) {
    // Return a basic error row if the connection fails
    http_response_code(500); // Set HTTP status code for error
    exit("<tr colspan='4'><td style='color: red;'>Database connection error.</td></tr>");
}

// 2. Read search keywords safely
$keywords = $_GET['keywords'] ?? ''; 
$keywords = trim($keywords);

// If search box is empty, stop execution and return nothing
if (empty($keywords)) {
    exit; 
}

// 3. Prepare and Execute Query (Using Prepared Statements for security)
// Selects all columns needed for the table display
$sql = "SELECT `game_ID`, `game_name`, `released_date`, `rating`
        FROM `games`
        WHERE `game_name` LIKE ?
        ORDER BY `released_date` DESC"; // Order by most recent first

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    exit("<tr colspan='4'><td style='color: red;'>Query preparation failed.</td></tr>");
}

$search_param = '%' . $keywords . '%';

$stmt->bind_param("s", $search_param);
$stmt->execute();
$results = $stmt->get_result();

// 4. Output Results (The HTML table rows)
if ($results->num_rows === 0) {
    // If no results, print a single row message
    echo "<tr><td colspan='4' style='color: #FF1493;'>No games found matching '<strong>" . htmlspecialchars($keywords) . "</strong>'.</td></tr>";
} else {
    // Loop through results and print each row
    while ($a_row = $results->fetch_assoc()): 
?>
    <tr>
        <td data-label="Game Name">
            <a href="details.php?id=<?= htmlspecialchars($a_row['game_ID']) ?>">
                <?= htmlspecialchars($a_row['game_name']) ?>
            </a>
        </td>
        <td data-label="Release Date"><?= htmlspecialchars($a_row['released_date']) ?></td>
        <td data-label="IMDB Rating">
            <span style="color: #4dd0e1; text-shadow: 0 0 10px rgba(77, 208, 225, 0.9);">
                <?= htmlspecialchars($a_row['rating']) ?>
            </span>
        </td>
        <td data-label="Actions"> 
             <a href="delete.php?id=<?= htmlspecialchars($a_row['game_ID']) ?>" 
                onclick="return confirm('Are you sure you want to delete \'<?= htmlspecialchars($a_row['game_name']) ?>\'?');"
                class="delete-btn" style="color: #FF1493;">
                 [DELETE]
             </a>
             <a href="edit.php?ID=<?= htmlspecialchars($a_row['game_ID']) ?>" class="edit-btn" style="color: #4dd0e1;">
                 [EDIT]
             </a>
        </td>
    </tr>
<?php 
    endwhile;
}

$stmt->close();
$mysqli->close();
?>