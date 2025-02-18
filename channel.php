<?php
session_start();
include 'config.php'; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in!");
}

$user_id = $_SESSION['user_id'];

// Get user details
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("MySQL Error: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user) {
    die("User not found!");
}

// Get user videos
$query_videos = "SELECT * FROM videos WHERE user_id = ?";
$stmt_videos = $conn->prepare($query_videos);
if ($stmt_videos === false) {
    die("MySQL Error: " . $conn->error);
}
$stmt_videos->bind_param("i", $user_id);
$stmt_videos->execute();
$result_videos = $stmt_videos->get_result();
?><!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($user['username']); ?> - My Channel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body><div class="channel-container">
    <div class="profile-section">
        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture">
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
    </div><div class="videos-section">
    <h3>Uploaded Videos</h3>
    <div class="video-list">
        <?php while ($video = $result_videos->fetch_assoc()) { ?>
            <div class="video-item">
                <a href="watch.php?id=<?php echo $video['id']; ?>">
                    <img src="thumbnails/<?php echo $video['thumbnail']; ?>" alt="Video Thumbnail">
                    <p><?php echo htmlspecialchars($video['title']); ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

</div></body>
</html>
