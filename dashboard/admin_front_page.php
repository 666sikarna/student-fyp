<?php
global $conn;
include('includes/connection.php');


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
        echo "<script>alert('Video deleted successfully');
        window.location.href='videos.php';</script>";
    } else {
        echo "<script>alert('Error occurred. Try again!');</script>";
    }
}

if (isset($_GET['type']) && isset($_GET['approve'])) {
    $file_id_to_approve = $_GET['approve'];
    $type = $_GET['type'];

    $file_id_to_approve = mysqli_real_escape_string($conn, $file_id_to_approve);
    $type = mysqli_real_escape_string($conn, $type);

    if ($type == 'videos') {
        $approval_query = "UPDATE videos SET status = 'approved' WHERE video_id = $file_id_to_approve";
    } elseif ($type == 'questions') {
        $approval_query = "UPDATE questions SET status = 'approved' WHERE question_id = $file_id_to_approve";
    }

    $run_approval_query = mysqli_query($conn, $approval_query);

    if (mysqli_affected_rows($conn) > 0) {
        echo '<script>window.location.reload();</script>';
        exit();
    } else {
        // echo "Error: " . mysqli_error($conn);
    }
}
?>

<div class="w-100 mt-4">
    <h3>Note List</h3>
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

    <h3>Videos</h3>
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
                        $subject_name = $row['subject_name'];
                        $file_status = $row['status'];
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
                                    <a class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this video?')" href="?type=videos&approve=<?php echo $file_id; ?>">Approve</a>
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