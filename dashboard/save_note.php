<?php
// save_note.php

// Include necessary files and establish database connection
global $conn;
include('includes/connection.php');
include('includes/adminheader.php');

// Check if the form is submitted
if (isset($_POST['save_note'])) {
    // Get the file ID from the form
    $file_id = $_POST['file_id'];

    // Get the current user's ID from the session
    // Example: $user_id = $_SESSION['id'];

    // Perform the database update to add the note to the user's note list
    // Modify the query based on your database schema
    $insert_query = "INSERT INTO notes.user_note_list (user_id, note_id) VALUES ('$user_id', '$file_id')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        // Note successfully added to the user's note list
        echo "Note added to your note list!";
    } else {
        // Error handling if the insert fails
        echo "Error: " . mysqli_error($conn);
    }
}
