<?php
include 'includes/connection.php';
include 'includes/adminheader.php';

$fileType = '';
$fileId = '';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $fileType = $_GET['type'];
    $fileId = $_GET['id'];

    if ($fileType == 'notes') {
        $sql = "SELECT original_file_name, file, file_type FROM uploads WHERE file_id = $fileId LIMIT 1";
    } elseif ($fileType == 'question') {
        $sql = "SELECT original_file_name, file, file_type FROM questions WHERE question_id = $fileId LIMIT 1";
    }

    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
        exit;
    }

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $originalFileName = $row['original_file_name'];
        $actualFilePath = $row['file'];
        $file_type = $row['file_type'];
        $fileRoute = "./allfiles/$actualFilePath";

        $conn->close();

        $contentType = ($file_type == 'pdf') ? 'application/pdf' : 'application/octet-stream';
        header("Content-Type: $contentType");
        header("Content-Disposition: attachment; filename=$originalFileName");
        readfile($fileRoute);
        exit;
    } else {
        echo "File not found";
    }
} else {
    echo "Invalid parameters";
}
