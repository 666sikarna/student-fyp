<?php
global $conn;
include('includes/connection.php');
include('includes/adminheader.php');
include 'includes/adminnav.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Video</title>
</head>

<body>

    <?php
    $videoUrl = isset($_GET['url']) ? $_GET['url'] : '';
    // Parse the URL to get the query string
    $queryString = parse_url($videoUrl, PHP_URL_QUERY);

    // Parse the query string to get the value of the 'v' parameter
    parse_str($queryString, $queryParams);
    $video_id = isset($queryParams['v']) ? $queryParams['v'] : '';

    $embed_url = "https://www.youtube.com/embed/$video_id";

    if (!empty($videoUrl)) {
    ?>

        <div class="container mt-4">

            <h2>Video Viewer</h2>

            <form class="mt-2" method="post">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>View</th>
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
                                        <a class="btn btn-primary btn-sm" href='#' onclick="reloadIframe('<?php echo $url; ?>')">View</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>

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

    <?php
    } else {
        echo "<p>No video URL provided.</p>";
    }
    ?>

</body>

</html>