<?php
// add-game-form.php

// CRITICAL: Start the session to work with CAPTCHA code
session_start(); 

// Check for CAPTCHA error from the processing page
$error = $_GET['error'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add a New Game</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Add a game</h1>

<?php if ($error === 'captcha_failed'): ?>
    <div class="alert alert-danger" role="alert">
        <strong>Security Check Failed!</strong> The CAPTCHA code you entered was incorrect.
    </div>
<?php endif; ?>

<form action="add-game.php" method="post">
<div class="mb-3">
<label for="GameName" class="form-label">Game name</label>
<input type="text" class="form-control" Id="GameName" name="GameName" required>
</div>
<div class="mb-3">
<label for="GameDescription" class="form-label">Description</label>
<textarea class="form-control" Id="GameDescription" name="GameDescription" rows="5" required></textarea>
</div>
<div class="mb-3">
<label for="DateReleased" class="form-label">Date released</label>
<input type="date" class="form-control" Id="DateReleased" name="DateReleased" required>
</div>
<div class="mb-3">
<label for="GameRating" class="form-label">Game Rating (e.g., 8.5)</label>
<input type="number" step="0.1" min="0" max="10" class="form-control" Id="GameRating" name="GameRating" required>
</div>

<div class="mb-3 border p-3 rounded bg-light">
    <label class="form-label">Security Check: Enter the code below</label>
    <img src="captcha_generator.php" alt="CAPTCHA Image" style="border: 2px solid #555; margin-bottom: 10px; display: block;">
    <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Enter CAPTCHA Code" required autocomplete="off">
</div>
<button type="submit" class="btn btn-primary">Add Game</button>
<a href="games.php" class="btn btn-secondary">Back to List</a>

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6P7n9a7iE5S0N5X5A5P7O7x7g6M7D5F5N9X6E9J7T8V8Y8A9B8D0C9E8F0B" crossorigin="anonymous"></script>
</body>
</html>