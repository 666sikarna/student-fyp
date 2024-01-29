<?php
global $conn;
include('includes/connection.php');

if (isset($_GET['approve'])) {
    $file_id_to_approve = $_GET['approve'];

    $approval_query = "UPDATE uploads SET status = 'approved' WHERE file_id = $file_id_to_approve";
    $run_approval_query = mysqli_query($conn, $approval_query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Note has been approved');
        window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error occurred. Try again!');</script>";
    }
    exit();
}

if (isset($_GET['del']) && isset($_GET['type'])) {
    $id = mysqli_real_escape_string($conn, $_GET['del']);
    $type =  mysqli_real_escape_string($conn, $_GET['type']);

    if ($type == 'videos') {
        $del_query = "DELETE FROM videos WHERE video_id = $id";
    } elseif ($type == 'questions') {
        $del_query = "DELETE FROM questions WHERE question_id = $id";
    } else {
        $del_query = "DELETE FROM uploads WHERE file_id = $id";
    }

    $run_del_query = mysqli_query($conn, $del_query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) {
        if ($type == 'videos') {
            echo "<script>alert('Video deleted successfully');";
        } elseif ($type == 'questions') {
            echo "<script>alert('Question deleted successfully');";
        } else {
            echo "<script>alert('Notes deleted successfully');";
        }
        echo "<script>window.location.href='index.php';</script>";
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

<div class="w-100 mt-4">
    <h3>Notes</h3>
    <form action="submit" method="post">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-capitalize">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Uploaded by</th>
                    <th>Uploaded on</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM uploads u
                INNER JOIN subject s ON s.subject_id = u.subject_id
                ORDER BY file_uploaded_on DESC";
                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_query) > 0) :
                    while ($row = mysqli_fetch_array($run_query)) :
                        $file_id = $row['file_id'];
                        $file_name = $row['file_name'];
                        $file_description = $row['file_description'];
                        $file_type = $row['file_type'];
                        $file_date = $row['file_uploaded_on'];
                        $file_uploader = $row['file_uploader'];
                        $file_status = $row['status'];
                        $file = $row['file'];
                        $subject_name = $row['subject_name'];
                ?>
                        <tr>
                            <td><?php echo $file_name; ?></td>
                            <td><?php echo $file_description; ?></td>
                            <td><?php echo $subject_name; ?></td>
                            <td><?php echo $file_type; ?></td>
                            <td>
                                <a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank' class="text-capitalize"> <?php echo $file_uploader; ?> </a>
                            </td>
                            <td>
                                <?php echo date("F j, Y, g:i a", strtotime($file_date)); ?>
                            </td>
                            <td class="text-capitalize">
                                <?php echo $file_status; ?>
                            </td>
                            <td>
                                <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                    View
                                </a>
                                <?php
                                if ($file_status !== 'approved') {
                                ?>
                                    <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this note?')" href="?approve=<?php echo $file_id; ?>">Approve</a>
                                <?php
                                }
                                ?>
                                <a class="btn btn-danger btn-sm" role="button" onClick="return confirm('Are you sure you want to delete this post?')" href='?type=notes&del=<?php echo $file_id; ?>'>
                                    Delete
                                </a>
                            </td>
                        </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>
    </form>

    <h4>Questions</h4>
    <form class="mt-2" method="post">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Uploaded by</th>
                    <th>Uploaded on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM questions q
                                         INNER JOIN subject s on s.subject_id = q.subject_id
                                         INNER JOIN users u on u.id = q.uploaded_by";

                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_query) > 0) :
                    while ($row = mysqli_fetch_array($run_query)) :
                        $question_id = $row['question_id'];
                        $question_name = $row['question_name'];
                        $question_description = $row['question_description'];
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];
                        $username = $row['username'];
                        $file_type = $row['file_type'];
                        $upload_time = $row['upload_time'];
                        $file = $row['file'];
                        $uploaded_by = $row['uploaded_by'];
                        $username = $row['username'];
                ?>
                        <tr>
                            <td><?php echo $question_name; ?></td>
                            <td><?php echo $question_description; ?></td>
                            <td><?php echo $subject_name; ?></td>
                            <td><?php echo $file_type; ?></td>
                            <td><a href='viewprofile.php?name=<?php echo $uploaded_by; ?>' target='_blank'> <?php echo $username; ?> </a></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($upload_time)); ?></td>
                            <td>
                                <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                    View
                                </a>
                                <a class='btn btn-sm btn-primary' href="download_file.php?type=question&id=<?php echo $question_id; ?>" target='_blank'>
                                    Download
                                </a>
                                <a class="btn btn-danger btn-sm" role="button" onclick="confirm('Are you sure you want to delete this post?')" href='?type=questions&del=<?php echo $question_id; ?>'>
                                    Delete
                                </a>
                            </td>
                        </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>
    </form>

    <h3>Videos</h3>
    <form method="post">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-capitalize">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM videos v
                INNER JOIN users u ON u.id = v.file_uploader
                INNER JOIN subject s ON s.subject_id = v.subject_id
                ORDER BY file_uploader DESC";
                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_query) > 0) :
                    while ($row = mysqli_fetch_array($run_query)) :
                        $file_id = $row['video_id'];
                        $file_name = $row['video_name'];
                        $file_description = $row['video_description'];
                        $file_uploader = $row['file_uploader'];
                        $username = $row['username'];
                        $subject_name = $row['subject_name'];
                        $file_status = $row['status'];
                        $url = $row['url'];
                ?>
                        <tr>
                            <td><?php echo $file_name; ?></td>
                            <td><?php echo $file_description; ?></td>
                            <td><?php echo $subject_name; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href='?url=<?php echo $url; ?>'>View</a>
                                <a class="btn btn-danger btn-sm" role="button" onclick="confirm('Are you sure you want to delete this post?')" href='?type=videos&del=<?php echo $file_id; ?>'>
                                    Delete
                                </a>
                            </td>
                        </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>
        <iframe id="videoIframe" width="600" height="400" src="<?php echo $embed_url ?>" title="C++ in 100 Seconds" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </form>

</div>

<script>
    const iframe = document.getElementById('videoIframe');

    function getYouTubeVideoId(url) {
        var match = url.match(/[?&]v=([^&]*)/);
        return match && match[1] ? match[1] : '';
    }

    function viewVideo(newUrl) {
        var newVideoId = getYouTubeVideoId(newUrl);
        var newEmbedUrl = "https://www.youtube.com/embed/" + newVideoId;
        iframe.src = newEmbedUrl;
    }
</script>