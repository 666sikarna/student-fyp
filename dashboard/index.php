<?php global $conn;
include('includes/connection.php');
include('includes/adminheader.php'); ?>

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
        <div class="">
            <?php if ($_SESSION['role'] == 'admin') {
            ?>
                <!-- ADMIN SESSION -->
                <div class="w-100 mt-4">
                    <marquee style="width: 70%;">
                        <h3 style="color: green"> Notes uploaded by various users</h3>
                    </marquee>

                    <!-- Table -->
                    <form action="submit" method="post">
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Uploaded on</th>
                                    <th>Uploaded by</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Approve</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0) {
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $file_id = $row['file_id'];
                                        $file_name = $row['file_name'];
                                        $file_description = $row['file_description'];
                                        $file_type = $row['file_type'];
                                        $file_date = $row['file_uploaded_on'];
                                        $file_uploader = $row['file_uploader'];
                                        $file_status = $row['status'];
                                        $file = $row['file'];

                                        echo "<tr>";
                                        echo "<td>$file_name</td>";
                                        echo "<td>$file_description</td>";
                                        echo "<td>$file_type</td>";
                                        echo "<td>$file_date</td>";
                                        echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank'> $file_uploader </a></td>";
                                        echo "<td>$file_status</td>";
                                        echo "<td><a href='allfiles/$file' target='_blank' style='color:green'>View</a></td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to approve this note?')\"href='?approve=$file_id'><i class='fa fa-times' style='color: red;'></i>Approve</a></td>";
                                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$file_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class=w-100">
                    <center>
                        <marquee style="width: 70%;">
                            <h3 style="color: green;"><?php echo $_SESSION['course']; ?> Engineering </h3>
                            <h3 style="color: brown;"> notes uploaded by various users</h3>
                        </marquee>
                    </center>

                    <form action="" method="post">
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
                                if (mysqli_num_rows($run_query) > 0) {
                                    while ($row = mysqli_fetch_array($run_query)) {
                                        $file_id = $row['file_id'];
                                        $file_name = $row['file_name'];
                                        $file_description = $row['file_description'];
                                        $file_type = $row['file_type'];
                                        $file_date = $row['file_uploaded_on'];
                                        $file = $row['file'];
                                        $file_uploader = $row['file_uploader'];

                                        echo "<tr>";
                                        echo "<td>$file_name</td>";
                                        echo "<td>$file_description</td>";
                                        echo "<td>$file_type</td>";
                                        echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank'> $file_uploader </a></td>";
                                        echo "<td>$file_date</td>";
                                        // echo "<td><a href='allfiles/$file' target='_blank' style='color:green'>Save</a></td>";
                                        echo "<td>
                                            <button class='btn btn-success btn-sm'>
                                            Save
                                            </button></td>";

                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            <?php
            } ?>
        </div>
    </div>
</body>

</html>