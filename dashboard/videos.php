<?php include 'includes/connection.php'; ?>
<?php include 'includes/adminheader.php';

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    header("location: index.php");
}

if (isset($_GET['del'])) {
    $video_id = mysqli_real_escape_string($conn, $_GET['del']);

    $del_query = "DELETE FROM videos WHERE video_id = $video_id";

    $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Video deleted successfully');
        window.location.href='videos.php';</script>";
    } else {
        echo "<script>alert('Error occurred. Try again!');</script>";
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
            <h1>My Videos</h1>
            <div class="col-xs-4">
                <a href="uploadvideos.php" class="btn btn-primary">Add New Video</a>
            </div>
        </div>
        <div class="mt-4">
            <form action="" method="post">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Subject</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentuser = $_SESSION['id'];
                        $query = "SELECT video_id, video_name, video_description, url, status, subject_name, u.username
                        FROM videos
                            INNER JOIN subject s ON videos.subject_id = s.subject_id
                            INNER JOIN users u ON videos.file_uploader = u.id
                            WHERE videos.file_uploader = '$currentuser'
                            ORDER BY video_id DESC";

                        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        if (mysqli_num_rows($run_query) > 0) {
                            while ($row = mysqli_fetch_array($run_query)) {
                                $video_id = $row['video_id'];
                                $video_name = $row['video_name'];
                                $video_description = $row['video_description'];
                                $url = $row['url'];
                                $status = $row['status'];
                                $subject_name = $row['subject_name'];
                                $uploaded_by = $row['username'];
                        ?>
                                <tr>
                                    <td><?php echo $video_name; ?></td>
                                    <td><?php echo $video_description; ?></td>
                                    <td><?php echo $url; ?></td>
                                    <td class="text-capitalize"><?php if ($status == 'pending') {
                                                                    echo "Pending approval";
                                                                }; ?></td>
                                    <td><?php echo $subject_name; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href='allfiles/<?php echo $file; ?>' target='_blank' style='color:white;'>View</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" onclick="confirm('Are you sure you want to delete this video?')" href='?del=<?php echo $video_id; ?>'>
                                            <i class='fa fa-trash' style='color: white;'></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>

</html>