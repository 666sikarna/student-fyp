<?php
include 'includes/connection.php';
include 'includes/adminheader.php';

if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
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

if (isset($_GET['approve'])) {
    $video_id = mysqli_real_escape_string($conn, $_GET['approve']);

    $del_query = "UPDATE videos SET status = 'approved' WHERE video_id = $video_id";

    $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Video has been approved');
        window.location.href='videos.php';</script>";
    } else {
        echo "<script>alert('Error occurred. Try again!');</script>";
    }
}


$videoUrl = isset($_GET['url']) ? $_GET['url'] : '';
$queryString = parse_url($videoUrl, PHP_URL_QUERY) ?? "test";
parse_str($queryString, $queryParams);
$video_id = isset($queryParams['v']) ? $queryParams['v'] : '';
$embed_url = "https://www.youtube.com/embed/$video_id";
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
                            <th>Subject</th>
                            <th>Description</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentuser = $_SESSION['id'];
                        $query = "SELECT video_id, video_name, video_description, url, status, subject_name, u.username as username
                                FROM videos v
                                    INNER JOIN subject s ON v.subject_id = s.subject_id
                                    INNER JOIN users u ON v.file_uploader = u.id
                                    WHERE status != 'pending'
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
                                    <td><?php echo $subject_name; ?></td>
                                    <td><?php echo $video_description; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href='?url=<?php echo urlencode($url); ?>'>View</a>
                                    </td>
                                    <?php if ($status !== 'approved') { ?>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href='?approve=<?php echo $video_id ?>'>Approve</a>
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href='?del=<?php echo $video_id ?>'>Delete</a>
                                        </td>
                                    <?php } ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

        <iframe id="videoIframe" width="893" height="502" src="<?php echo $embed_url ?>" title="C++ in 100 Seconds" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

    </div>


    <script>
        function reloadIframe(newUrl) {
            var iframe = document.getElementById('videoIframe');
            var newVideoId = getYouTubeVideoId(newUrl);
            var newEmbedUrl = "https://www.youtube.com/embed/" + newVideoId;
            iframe.src = newEmbedUrl;
        }

        function getYouTubeVideoId(url) {
            var match = url.match(/[?&]v=([^&]*)/);
            return match && match[1] ? match[1] : '';
        }
    </script>
</body>

</html>