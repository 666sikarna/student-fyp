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
                                    <th>Add to collection</th>
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
                                                <button class='btn btn-success btn-sm'>
                                                    Save
                                                </button>
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
                                    <th>Type</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded on</th>
                                    <th>Add to collection</th>
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
                                                <button class='btn btn-success btn-sm'>
                                                    Save
                                                </button>
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
                                    <th>Type</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded on</th>
                                    <th>Add to collection</th>
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
                                                <button class='btn btn-success btn-sm'>
                                                    Save
                                                </button>
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
</body>

</html>