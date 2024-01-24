<?php
include('includes/connection.php');
include('includes/adminheader.php');
?>

<div id="wrapper">
    <?php include 'includes/adminnav.php'; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    if (isset($_GET['name'])) {
                        $user = mysqli_real_escape_string($conn, $_GET['name']);
                        $query = "SELECT * FROM users WHERE username= '$user' ";
                        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));

                        if (mysqli_num_rows($run_query) > 0) {
                            while ($row = mysqli_fetch_array($run_query)) {
                                $name = $row['name'];
                                $email = $row['email'];
                                $course = $row['course'];
                                $role = $row['role'];
                                $bio = $row['about'];
                                $image = $row['image'];
                                $joindate = $row['joindate'];
                                $gender = $row['gender'];
                            }
                        } else {
                            $name = "N/A";
                            $email = "N/A";
                            $course = "N/A";
                            $role = "N/A";
                            $bio = "N/A";
                            $image = "profile.jpg";
                            $gender = "N/A";
                            $joindate = "N/A";
                        }
                    ?>
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <img src="profilepics/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="card-img-top img-fluid" />
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $name; ?></h5>
                                            <p class="card-text">
                                                <strong>Department:</strong>
                                                <span class="capitalize">
                                                    <?php echo $course; ?>
                                                </span>
                                                <br />
                                                <strong>Role:</strong>
                                                <span class="capitalize">
                                                    <?php echo $role; ?>
                                                </span>
                                                <br />
                                                <strong>Gender:</strong> <?php echo $gender; ?><br />
                                                <strong>Email:</strong> <?php echo $email; ?><br />
                                                <strong>Join Date:</strong> <?php echo $joindate; ?><br />
                                                <strong>Bio:</strong> <?php echo $bio; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                        header("location:index.php");
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .capitalize {
        text-transform: capitalize;
    }
</style>

</body>

</html>