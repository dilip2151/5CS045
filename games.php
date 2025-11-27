<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Archive</title>
    <style>
        /* Base Palette: Dark Grey, Neon Pink (#FF1493), Cyan/Teal (#00CED1), Sand Text (#EAE0CF) */

        body {
            font-family: 'Orbitron', sans-serif, 'Consolas', monospace;
            background: linear-gradient(145deg, #292E36 0%, #1F2328 100%); 
            color: #EAE0CF;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            overflow-x: hidden;
            position: relative;
        }

        /* Subtle textured background layer */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Simple small grid pattern */
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiM0NDQ5NTMiIGZpbGwtb3BhY2VpdHk9IjAuMSI+PHBhdGggZD0wTjIwIDExLjA5NFYyMEgwdjguOTA2YzAtMi45NTkgMi44NDMtNC44NTUgNy41NjItNC44NTVgMTAuMDc0Ljk5IDIuNDMgMi41NTUtMi40MzUgMi41NTUtNy40OTUtMi41NTUgMy40NTMgMi41NTUgNy41NzcgMi41NTUgMi41NzcgMC00LjcxMi0xLjgzNS03LjU5Mi00Ljg1NVoiLz48L2c+PC9nPg==');
            opacity: 0.1;
            z-index: -1;
        }

        header {
            background-color: rgba(31, 35, 40, 0.98);
            border-bottom: 3px solid #FF1493;
            padding: 30px 40px;
            width: 100%;
            text-align: center;
            /* Simplified shadow */
            box-shadow: 0 5px 20px rgba(255, 20, 147, 0.7);
            position: relative;
        }

        h1 {
            margin: 0;
            font-size: 3.5em;
            color: #FFFFFF;
            /* Toned down glow */
            text-shadow: 0 0 15px #FF1493, 0 0 5px #FF1493;
            letter-spacing: 4px; 
            text-transform: uppercase;
        }
        h1::after { /* Underline effect with glow */
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background-color: #FF1493;
            margin: 10px auto 0;
            box-shadow: 0 0 8px #FF1493;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            flex-grow: 1;
            position: relative;
            padding: 20px;
            background-color: rgba(31, 35, 40, 0.7);
            border: 1px solid rgba(0, 206, 209, 0.4);
            border-radius: 10px; /* Slightly simpler border radius */
            /* Simplified shadow */
            box-shadow: 0 0 40px rgba(255, 20, 147, 0.3), 0 0 15px rgba(0, 206, 209, 0.2);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        form {
            text-align: center;
            margin-bottom: 40px; 
            padding: 20px;
            background-color: rgba(41, 46, 54, 0.8);
            border: 1px solid #00CED1;
            border-radius: 8px;
            /* Simplified shadow */
            box-shadow: 0 0 10px rgba(255, 20, 147, 0.1), inset 0 0 8px rgba(0, 206, 209, 0.3);
            position: relative;
        }
        form::before { /* Small top border detail */
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px; /* Made smaller */
            height: 2px;
            background-color: #FF1493;
            box-shadow: 0 0 8px #FF1493;
        }

        input[type="text"] {
            padding: 14px; /* Smaller padding */
            width: 350px; /* Slightly narrower input */
            border: 2px solid #FF1493;
            border-radius: 5px;
            background-color: #1F2328;
            color: #EAE0CF;
            font-size: 1em;
            /* Simplified shadow */
            box-shadow: inset 0 0 8px rgba(255, 20, 147, 0.8);
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        input[type="text"]:focus {
            border-color: #FFFFFF;
            outline: none;
            /* Simplified focus glow */
            box-shadow: 0 0 18px #FF1493, inset 0 0 10px #FF1493;
        }
        input[type="submit"] {
            padding: 14px 30px; /* Smaller padding */
            background-color: #00CED1;
            color: #1F2328;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1em;
            /* Simplified shadow */
            box-shadow: 0 0 10px rgba(0, 206, 209, 0.6);
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            margin-left: 15px; /* Less space */
        }
        input[type="submit"]:hover {
            background-color: #FF1493; 
            color: #FFFFFF;
            /* Simplified hover glow */
            box-shadow: 0 0 20px rgba(255, 20, 147, 1);
        }
        table {
            width: 100%;
            margin: 40px 0 0;
            border-collapse: collapse;
            background-color: rgba(31, 35, 40, 0.85);
            border: 1px solid #00CED1;
            border-radius: 8px;
            overflow: hidden;
            /* Simplified shadow */
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.2), inset 0 0 10px rgba(255, 255, 255, 0.05);
        }
        th, td {
            padding: 18px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 20, 147, 0.3);
            position: relative;
        }
        th {
            background-color: #00CED1; 
            color: #1F2328;
            /* Simplified text shadow */
            text-shadow: 0 0 5px #FF1493; 
            text-transform: uppercase;
            letter-spacing: 1px; /* Tighter letter spacing */
            font-size: 1.1em;
            border-bottom: 3px solid #FF1493; /* Thinner separator */
        }
        th:not(:last-child)::after { /* Vertical separator glow */
            content: '';
            position: absolute;
            right: 0;
            top: 20%; /* Adjusted height */
            height: 60%;
            width: 1px; /* Thinner */
            background-color: rgba(255, 20, 147, 0.4);
            box-shadow: 0 0 5px rgba(255, 20, 147, 0.6);
        }
        tr:nth-child(even) {
            background-color: rgba(41, 46, 54, 0.6);
        }
        tr:hover {
            background-color: rgba(255, 20, 147, 0.15); /* Lighter hover tint */
            cursor: pointer;
            box-shadow: inset 0 0 8px rgba(255, 20, 147, 0.3); /* Simpler inner hover glow */
        }
        a {
            color: #FF1493;
            text-decoration: none;
            font-weight: bold;
            font-size: 1em; /* Smaller font size */
            /* Simplified link glow */
            text-shadow: 0 0 8px rgba(255, 20, 147, 0.8);
            transition: color 0.3s ease-in-out, text-shadow 0.3s ease-in-out;
        }
        a:hover {
            color: #00CED1;
            text-shadow: none;
        }

        /* --- NEW STYLES FOR DELETE AND EDIT BUTTONS --- */

        .delete-btn {
            color: #FF0000; /* Neon Red */
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.8), 0 0 5px rgba(255, 0, 0, 0.5);
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #FF0000;
            border-radius: 4px;
            background: rgba(255, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .delete-btn:hover {
            color: #FFFFFF;
            background: #FF0000;
            box-shadow: 0 0 15px #FF0000;
            text-shadow: none;
        }

        .edit-btn {
            color: #FF4500; /* Neon Orange */
            text-shadow: 0 0 10px rgba(255, 69, 0, 0.8), 0 0 5px rgba(255, 69, 0, 0.5);
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #FF4500;
            border-radius: 4px;
            background: rgba(255, 69, 0, 0.1);
            margin-left: 10px;
            transition: all 0.2s ease-in-out;
        }

        .edit-btn:hover {
            color: #1F2328;
            background: #FF4500;
            box-shadow: 0 0 15px #FF4500;
            text-shadow: none;
        }
        
        /* --- END NEW STYLES --- */


        footer {
            text-align: center;
            padding: 20px; /* Smaller padding */
            width: 100%;
            background-color: rgba(31, 35, 40, 0.98);
            color: #FF1493;
            margin-top: 40px;
            border-top: 3px solid #FF1493;
            /* Simplified footer glow */
            text-shadow: 0 0 10px #FF1493;
            font-size: 0.9em;
            letter-spacing: 1px;
            position: relative;
            z-index: 10;
        }
        .error-message {
            color: #FF1493; 
            text-align:center; 
            font-weight:bold; 
            font-size: 1.1em; /* Smaller font size */
            text-shadow: 0 0 10px #FF1493; 
            padding: 20px; 
            border: 1px dashed #00CED1; /* Thinner dashed border */
            background-color: rgba(41, 46, 54, 0.9);
            margin: 20px auto;
            width: fit-content;
            max-width: 80%;
            border-radius: 6px; /* Smaller radius */
            /* Simplified error box glow */
            box-shadow: 0 0 15px rgba(255, 20, 147, 0.7); 
        }

        /* Responsive adjustments (Kept mostly the same as this is good practice) */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2em;
                letter-spacing: 2px;
            }
            input[type="text"] {
                width: calc(100% - 30px);
                margin-bottom: 10px;
            }
            input[type="submit"] {
                width: calc(100% - 30px);
                margin-left: 0;
            }
            form {
                padding: 15px;
            }
            th, td {
                padding: 10px;
                font-size: 0.9em;
            }
            
            /* Hide columns on small screens */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid rgba(0, 206, 209, 0.4);
                border-radius: 8px;
            }

            td {
                border: none;
                border-bottom: 1px solid rgba(255, 20, 147, 0.1);
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: #00CED1;
            }
            
            /* Remove column headers on mobile */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5em;
                letter-spacing: 1px;
            }
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1> My Game Collection </h1>
    </header>

    <div class="container">
        <?php
        // Connect to database
        $mysqli = new mysqli("localhost", "2407414", "Bandhana@123456", "db2407414");

        if ($mysqli->connect_errno) {
            // Reverted to a standard, less dramatic error message
            echo "<p class='error-message'>ERROR: Failed to connect to MySQL: " . $mysqli->connect_error . "</p>";
        }

        // Run SQL query
        $sql = "SELECT * FROM games ORDER BY rating DESC";
        $results = isset($mysqli) && !$mysqli->connect_errno ? $mysqli->query($sql) : null;
        ?>

        <form action="search.php" method="post">
        <input type="text" name="keywords" placeholder="Search for a game...">
        <input type="submit" value="Search"> </form>
	 <a href="add-game-form.php" class="btn btn-primary">Add a game</a>


        <table>
            <thead>
                <tr>
                    <th> Game Name</th>
                    <th> Release Date</th>
                    <th> IMDB Rating</th>
					
                </tr>
            </thead>
            <tbody>
                <?php
                // Mock data if the connection failed, to show the style
                if (!$results || (isset($results) && $results->num_rows === 0)) {
                    $mock_data = [
                        ['game_name' => 'Desert Runner 404', 'released_date' => '2077-10-23', 'rating' => '9.2'],
                        ['game_name' => 'Spice Harvester: The Board Game', 'released_date' => '1984-12-18', 'rating' => '8.8'],
                        ['game_name' => 'Neon District Protocol', 'released_date' => '2049-05-15', 'rating' => '7.9'],
                        ['game_name' => 'Fremen Tactics Simulator', 'released_date' => '2025-01-01', 'rating' => '9.5']
                    ];
                    foreach ($mock_data as $index => $row):
                ?>
                <tr>
                    <td data-label="Game Name">
                        <a href="details.php?id=<?= $index + 100 ?>">
                            <?= htmlspecialchars($row['game_name']) ?>
                        </a>
                    </td>
                    <td data-label="Release Date"><?= htmlspecialchars($row['released_date']) ?></td>
                    <td data-label="IMDB Rating">
                        <span style="color: #FF1493; text-shadow: 0 0 10px rgba(255, 20, 147, 0.9);">
                            <?= htmlspecialchars($row['rating']) ?>
                        </span>
                    </td>
                    <td data-label="Actions (Mock)">
                         <a href="delete.php?id=<?= $index + 100 ?>"
                            onclick="return confirm('Are you sure you want to delete \'<?= htmlspecialchars($row['game_name']) ?>\'?');"
                            class="delete-btn">
                             [DELETE]
                         </a>
                         <a href="edit.php?ID=<?= $index + 100 ?>" class="edit-btn">
                             [EDIT]
                         </a>
                    </td>
                </tr>
                <?php
                    endforeach;
                } else {
                    // Original PHP logic if connection succeeded
                    while ($a_row = $results->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Game Name">
                            <a href="details.php?id=<?= htmlspecialchars($a_row['game_ID']) ?>">
                                <?= htmlspecialchars($a_row['game_name']) ?>
                            </a>
                        </td>
                        <td data-label="Release Date"><?= htmlspecialchars($a_row['released_date']) ?></td>
                        <td data-label="IMDB Rating">
                            <span style="color: #FF1493; text-shadow: 0 0 10px rgba(255, 20, 147, 0.9);">
                                <?= htmlspecialchars($a_row['rating']) ?>
                            </span>
                        </td>
                        <td data-label="Actions"> 
                             <a href="delete.php?id=<?= htmlspecialchars($a_row['game_ID']) ?>" 
                               onclick="return confirm('Are you sure you want to delete \'<?= htmlspecialchars($a_row['game_name']) ?>\'?');"
                               class="delete-btn">
                                 [DELETE]
                             </a>
                             <a href="edit.php?ID=<?= htmlspecialchars($a_row['game_ID']) ?>" class="edit-btn">
                                 [EDIT]
                             </a>
                        </td>
                    </tr>
                    <?php endwhile;
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; <?= date("Y") ?> **Game Archive** | Data Stable</p> </footer>
</body>
</html>