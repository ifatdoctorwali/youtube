<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorts</title>
</head>
<body>
    <h2>Shorts</h2>

    <?php
    $sql = "SELECT * FROM shorts ORDER BY id DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Database Query Failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<video width='200' height='350' controls>";
            echo "<source src='shorts/" . $row["filename"] . "' type='video/mp4'>";
            echo "Your browser does not support the video tag.";
            echo "</video>";
            echo "<p>" . $row["title"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No Shorts available.</p>";
    }
    ?>
</body>
</html>
