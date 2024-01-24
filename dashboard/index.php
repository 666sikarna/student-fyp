<?php
global $conn;
include('includes/connection.php');
include('includes/adminheader.php');

if (isset($_GET['approve'])) {
    $file_id_to_approve = $_GET['approve'];

    $approval_query = "UPDATE uploads SET status = 'approved' WHERE file_id = $file_id_to_approve";
    $run_approval_query = mysqli_query($conn, $approval_query);

    header("location: index.php");
    exit();
}
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
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <div class="w-100 mt-4">
                    <marquee style="width: 70%;">
                        <h3 style="color: green"> Notes uploaded by various users</h3>
                    </marquee>

                    <form action="submit" method="post">
                        <table class="table table-striped border">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Uploaded on</th>
                                    <th>Uploaded by</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
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
                                ?>
                                        <tr>
                                            <td><?php echo $file_name; ?></td>
                                            <td><?php echo $file_description; ?></td>
                                            <td><?php echo $file_type; ?></td>
                                            <td>
                                                <?php echo date("F j, Y, g:i a", strtotime($file_date)); ?>
                                            </td>
                                            <td>
                                                <a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank'> <?php echo $file_uploader; ?> </a>
                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo $file_status; ?>
                                            </td>
                                            <td>
                                                <a href='allfiles/<?php echo $file; ?>' target='_blank' class="btn btn-primary btn-sm">View</a>
                                                <?php
                                                if ($file_status !== 'approved') {
                                                ?>
                                                    <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this note?')" href="?approve=<?php echo $file_id; ?>">Approve</a>
                                                <?php
                                                }
                                                ?>
                                                <a class="btn btn-danger btn-sm" role="button" onClick="return confirm('Are you sure you want to delete this post?')" href='?del=<?php echo $file_id; ?>'>
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

                    <!-- Video table -->

                    <form action="submit" method="post">
                        <table class="table table-striped border">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Uploaded on</th>
                                    <th>Uploaded by</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
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
                                ?>
                                        <tr>
                                            <td><?php echo $file_name; ?></td>
                                            <td><?php echo $file_description; ?></td>
                                            <td><?php echo $file_type; ?></td>
                                            <td>
                                                <?php echo date("F j, Y, g:i a", strtotime($file_date)); ?>
                                            </td>
                                            <td>
                                                <a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank'> <?php echo $file_uploader; ?> </a>
                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo $file_status; ?>
                                            </td>
                                            <td>
                                                <a href='allfiles/<?php echo $file; ?>' target='_blank' class="btn btn-primary btn-sm">View</a>
                                                <?php
                                                if ($file_status !== 'approved') {
                                                ?>
                                                    <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this note?')" href="?approve=<?php echo $file_id; ?>">Approve</a>
                                                <?php
                                                }
                                                ?>
                                                <a class="btn btn-danger btn-sm" role="button" onClick="return confirm('Are you sure you want to delete this post?')" href='?del=<?php echo $file_id; ?>'>
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
                </div>
            <?php else : ?>
                <div class="w-100">
                    <center>
                        <marquee style="width: 70%;">
                            <h3 style="color: green;"><?php echo $_SESSION['course']; ?> Engineering </h3>
                            <h3 style="color: brown;"> notes uploaded by various users</h3>
                        </marquee>
                    </center>


                    <h4>Notes</h4>
                    <form class="mt-2" method="post">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentusercourse = $_SESSION['course'];

                                $query = "SELECT * FROM uploads WHERE file_uploaded_to = '$currentusercourse' AND status = 'approved' ORDER BY file_uploaded_on DESC";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0) :
                                    while ($row = mysqli_fetch_array($run_query)) :
                                        $file_id = $row['file_id'];
                                        $file_name = $row['file_name'];
                                        $file_description = $row['file_description'];
                                        $file_type = $row['file_type'];
                                        $file_date = $row['file_uploaded_on'];
                                        $file = $row['file'];
                                        $file_uploader = $row['file_uploader'];
                                ?>
                                        <tr>
                                            <td><?php echo $file_name; ?></td>
                                            <td><?php echo $file_description; ?></td>
                                            <td><?php echo $file_type; ?></td>
                                            <td><a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank'> <?php echo $file_uploader; ?> </a></td>
                                            <td><?php echo date("F j, Y, g:i a", strtotime($file_date)); ?></td>
                                            <td>
                                                <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                                    View
                                                </a>
                                                <a class='btn btn-sm btn-primary' href="allfiles/<?php echo $file; ?>" target='_blank' download>
                                                    Download
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

                    <!-- Video table -->
                    <h4>Videos</h4>
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
                                                <a class="btn btn-primary btn-sm" href='view_video.php?url=<?php echo urlencode($url); ?>'>View</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>

                    <!-- Question -->
                    <h4>Questions</h4>
                    <form class="mt-2" method="post">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentusercourse = $_SESSION['course'];

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
                                ?>
                                        <tr>
                                            <td><?php echo $file_name; ?></td>
                                            <td><?php echo $file_description; ?></td>
                                            <td><?php echo $file_type; ?></td>
                                            <td><a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank'> <?php echo $file_uploader; ?> </a></td>
                                            <td><?php echo date("F j, Y, g:i a", strtotime($file_date)); ?></td>
                                            <td>
                                                <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                                    View
                                                </a>
                                                <a class='btn btn-sm btn-primary' href="allfiles/<?php echo $file; ?>" target='_blank' download>
                                                    Download
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
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function displayPdf(file_path, file_name) {
            window.open('view_pdf.php?file_path=' + encodeURIComponent(file_path) + '&file_name=' + encodeURIComponent(file_name), '_blank');
        }
    </script>
</body>

</html>