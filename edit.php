<?php
// edit.php - Edit a game record

// DB connection (same credentials you used elsewhere)
$mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");
if ($mysqli->connect_errno) {
    die("<p class='error-message'>ERROR: Failed to connect to MySQL: " . $mysqli->connect_error . "</p>");
}

// Accept either ?ID= or ?id=
if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);
} elseif (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die("No game selected.");
}

// Fetch existing game data
$stmt = $mysqli->prepare("SELECT game_ID, game_name, game_description, released_date, rating FROM games WHERE game_ID = ?");
if (!$stmt) { die("Prepare failed: " . $mysqli->error); }
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Game not found.");
}
$game = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // field names changed to game_description
    $name         = trim($_POST['game_name']);
    $description  = trim($_POST['game_description']);  // changed
    $release_date = trim($_POST['released_date']);
    $rating       = trim($_POST['rating']);

    // Basic validation
    if ($name === '' || $description === '' || $release_date === '' || $rating === '') {
        $error = "All fields are required.";
    } else {
        $update = $mysqli->prepare("
            UPDATE games
            SET game_name = ?, game_description = ?, released_date = ?, rating = ?
            WHERE game_ID = ?
        ");

        if (!$update) {
            die("Prepare failed: " . $mysqli->error);
        }

        // Bind parameters
        $update->bind_param("ssssi", $name, $description, $release_date, $rating, $id);

        if ($update->execute()) {
            $update->close();
            header("Location: games.php");
            exit;
        } else {
            $error = "Error updating: " . $mysqli->error;
            $update->close();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Game</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .navbar {
        background: #333;
        color: #fff;
        padding: 15px;
        text-align: center;
        font-size: 1.3em;
    }

    .container {
        max-width: 700px;
        margin: 30px auto;
        padding: 15px;
    }

    .card {
        background: #fff;
        padding: 25px;
        border-radius: 6px;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #aaa;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        background: #333;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background: #555;
    }

    .back-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 8px 15px;
        background: #999;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .back-btn:hover {
        background: #777;
    }

    .error {
        color: red;
        margin-top: 10px;
    }
</style>

</head>
<body>
<div class="navbar"><h2>✏ Edit Game Record</h2></div>
<div class="container">
    <div class="card">
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="game_name">Game Name:</label>
            <input type="text" id="game_name" name="game_name" value="<?= htmlspecialchars($game['game_name']) ?>" required>

            <label for="game_description">Game Description:</label>
            <textarea id="game_description" name="game_description" rows="5" required><?= htmlspecialchars($game['game_description']) ?></textarea>

            <label for="released_date">Release Date:</label>
            <input type="date" id="released_date" name="released_date" value="<?= htmlspecialchars($game['released_date']) ?>" required>

            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating" value="<?= htmlspecialchars($game['rating']) ?>" required>

            <button type="submit">💾 Save Changes</button>
        </form>

        <a href="games.php" class="back-btn">⬅ Back to List</a>
    </div>
</div>
</body>
</html>
