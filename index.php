<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        .navbar {
            background: red;
            color: white;
            padding: 15px;
            text-align: left;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            padding-left: 20px;
        }

        .navbar .my-channel {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding-right: 20px;
        }

        .sidebar {
            width: 200px;
            background: #f1f1f1;
            padding: 15px;
            height: 100vh;
            position: fixed;
            top: 50px;
            left: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            font-size: 18px;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            width: 100%;
            margin-top: 70px;
        }

        .video-gallery {
            display: flex;
            flex-wrap: wrap;
        }

        .video-item {
            margin: 15px;
            text-align: center;
        }

        .subscribe-btn {
            background: red;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>YouTube Clone</h2>
        <a href="mychannel.php" class="my-channel">My Channel</a>
    </div>

    <div class="sidebar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shorts.php">Shorts</a></li>
            <li><a href="subscriptions.php">Subscriptions</a></li>
            <li><a href="yourvideos.php">Your Videos</a></li>
            <li><a href="watchlater.php">Watch Later</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Video Title" required>
            <input type="file" name="video" required>
            <button type="submit">Upload Video</button>
        </form>

        <h2>Videos</h2>
        <div class="video-gallery">
            <?php
            $sql = "SELECT * FROM videos ORDER BY id DESC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='video-item'>";
                echo "<video width='320' height='240' controls>
                        <source src='videos/" . $row["filename"] . "' type='video/mp4'>
                      </video>";
                echo "<p>" . $row["title"] . "</p>";
                echo "<button class='subscribe-btn'>Subscribe</button>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
