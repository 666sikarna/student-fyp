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
        echo "<div>$fileType $fileId</div>";

        $row = $result->fetch_assoc();
        $originalFileName = $row['original_file_name'];
        $actualFilePath = $row['file'];
        $file_type = $row['file_type'];
        $fileExtension = pathinfo($actualFilePath, PATHINFO_EXTENSION);

        $file_name = "$originalFileName.$fileExtension";



        $conn->close();

        $contentType = ($file_type == 'pdf') ? 'application/pdf' : 'application/octet-stream';
        echo "<script>$file_name</script>";
        // header("Content-Type: $contentType");
        // header("Content-Disposition: attachment; filename=$file_name");
        // readfile(__DIR__ . "/allfiles/$actualFilePath");
        // exit;
    } else {
        echo "File not found";
    }
} else {
    echo "Invalid parameters";
}
