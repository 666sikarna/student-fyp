<?php
global $conn;
include('includes/connection.php');
include('includes/adminheader.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | User</title>
</head>

<body>
    <?php include 'includes/adminnav.php' ?>
    <div class="container mt-4">
        <div id="welcome-title">
            <h3>Welcome <span style="text-transform: capitalize;"><?php echo $_SESSION['name']; ?></span></h3>
        </div>
        <div>
            <?php include ($_SESSION['role'] == 'admin') ? 'admin_front_page.php' : 'user_front_page.php'; ?>
        </div>
    </div>

    <script>
        function displayPdf(file_path, file_name) {
            window.open('view_pdf.php?file_path=' + encodeURIComponent(file_path) + '&file_name=' + encodeURIComponent(file_name), '_blank');
        }
    </script>
</body>

</html>