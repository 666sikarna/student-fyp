<div class="w-100">
    <center>
        <marquee style="width: 70%;">
            <h3 style="color: green;"> Study Tips ! </h3>
            <h3 style="color: brown;"> 1. Set clear study goals</h3>
            <h3 style="color: brown;"> 2. Utilise active learning strategies</h3>
        </marquee>
    </center>


    <h4>Notes</h4>
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
                $currentusercourse = $_SESSION['course'];

                $query = "SELECT * FROM uploads u
                INNER JOIN subject s ON u.subject_id = s.subject_id
                WHERE file_uploaded_to = '$currentusercourse' AND status = 'approved' ORDER BY file_uploaded_on DESC";

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
                        $subject_name = $row['subject_name'];
                ?>
                        <tr>
                            <td><?php echo $file_name; ?></td>
                            <td><?php echo $file_description; ?></td>
                            <td><?php echo $subject_name; ?></td>
                            <td><?php echo $file_type; ?></td>
                            <td><a href='viewprofile.php?name=<?php echo $file_uploader; ?>' target='_blank'> <?php echo $file_uploader; ?> </a></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($file_date)); ?></td>
                            <td>
                                <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                    View
                                </a>
                                <a class='btn btn-sm btn-primary' href="download_file.php?type=notes&id=<?php echo $file_id; ?>">
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

    <!-- Question -->
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
                    <th>Description</th>
                    <th>Subject</th>
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
                            <td><?php echo $video_description; ?></td>
                            <td><?php echo $subject_name; ?></td>
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
</div>