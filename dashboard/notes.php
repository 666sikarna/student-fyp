<?php include 'includes/connection.php'; ?>
<?php include 'includes/adminheader.php';
?>

<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    header("location: index.php");
}
?>

<?php


if (isset($_GET['del'])) {
    $note_del = mysqli_real_escape_string($conn, $_GET['del']);
    $file_uploader = $_SESSION['username'];
    $del_query = "DELETE FROM uploads WHERE file_id=$note_del;";
    $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Note deleted successfully');
        window.location.href='notes.php';</script>";
    } else {
        echo "<script>alert('error occured.try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Notes</title>

    <style>
        .capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <?php include 'includes/adminnav.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h1>My Notes</h1>
            <div class="col-xs-4">
                <a href="uploadnote.php" class="btn btn-primary">Add New Note</a>
            </div>
        </div>
        <div class="mt-4">
            <form action="" method="post">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Uploaded on</th>
                            <th>Status</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentuser = $_SESSION['username'];

                        $query = "SELECT * FROM uploads WHERE file_uploader= '$currentuser' ORDER BY file_uploaded_on DESC";
                        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        if (mysqli_num_rows($run_query) > 0) {
                            while ($row = mysqli_fetch_array($run_query)) {
                                $file_id = $row['file_id'];
                                $file_name = $row['file_name'];
                                $file_description = $row['file_description'];
                                $file_type = $row['file_type'];
                                $file_date = $row['file_uploaded_on'];
                                $file_status = $row['status'];
                                $file = $row['file'];
                        ?>
                                <tr>
                                    <td><?php echo $file_name; ?></td>
                                    <td><?php echo $file_description; ?></td>
                                    <td><?php echo $file_type; ?></td>
                                    <td><?php echo $file_date; ?></td>
                                    <td class='capitalize'><?php echo $file_status; ?></td>
                                    <td>
                                        <a href='allfiles/<?php echo $file; ?>' target='_blank' class="btn btn-primary btn-sm">View</a>
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this post?')" href='?del=<?php echo $file_id; ?>'>
                                            <i class='fa fa-trash' style="color: white;"></i> Delete</a>
                                    </td>
                                </tr> <?php
                                    }
                                } else {
                                    echo "<script>alert('Not notes yet! Start uploading now');
                            window.location.href= 'uploadnote.php';</script>";
                                }
                                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <script>
        function displayPdf(file_path, file_name) {
            window.open('view_pdf.php?file_path=' + encodeURIComponent(file_path) + '&file_name=' + encodeURIComponent(file_name), '_blank');
        }
    </script>
</body>

</html>