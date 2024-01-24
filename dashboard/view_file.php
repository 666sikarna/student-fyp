<?php
include 'includes/connection.php';

if (isset($_GET['file_id'])) {
    $file_id = mysqli_real_escape_string($conn, $_GET['file_id']);

    // Fetch file details from the database
    $query = "SELECT file_name, file_type, file_content FROM uploads WHERE file_id = '$file_id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $file_name = $row['file_name'];
        $file_type = $row['file_type'];
        $file_content = $row['file_content'];

        // Check if it's a PDF for inline display
        if ($file_type === 'pdf') {
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=$file_name.$file_type");
            echo base64_decode($file_content);
            exit();
        }

        // For other file types, initiate download
        header("Content-Disposition: attachment; filename=$file_name.$file_type");
        header("Content-type: application/octet-stream");
        echo $file_content;
        exit();
    }
}

// If file_id is not provided or file not found, redirect to an error page or handle accordingly
header("location: error.php");
exit();
