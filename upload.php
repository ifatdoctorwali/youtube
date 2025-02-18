<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["video"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["video"]["name"]);
    $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allow only MP4, AVI, MKV, MOV files
    $allowed_types = array("mp4", "avi", "mkv", "mov");
    if (!in_array($videoFileType, $allowed_types)) {
        die("Error: Only MP4, AVI, MKV, MOV files are allowed.");
    }

    // Move file to uploads folder
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
        // Insert video details into the database
        $title = $_POST['title'];
        $sql = "INSERT INTO videos (title, filename) VALUES ('$title', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "Video uploaded successfully!";
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
    }
}
?>
