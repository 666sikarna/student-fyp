<?php
include('includes/connection.php');
include('includes/adminheader.php');
?>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $userid = $row['id'];
        $usernm = $row['username'];
        $userpassword = $row['password'];
        $useremail = $row['email'];
        $name = $row['name'];
        $profilepic = $row['image'];
        $bio = $row['about'];
    }

    if (isset($_POST['uploadphoto'])) {
        $image = $_FILES['image']['name'];
        $ext = $_FILES['image']['type'];
        $validExt = array("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");

        if (empty($image)) {
            $picture = $profilepic;
        } elseif ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000) {
            echo "<script>alert('Image size is not proper'); window.location.href='userprofile.php';</script>";
        } elseif (!in_array($ext, $validExt)) {
            echo "<script>alert('Not a valid image'); window.location.href='userprofile.php';</script>";
        } else {
            $folder  = 'profilepics/';
            $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            $picture = rand(1000, 1000000) . '.' . $imgext;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $folder . $picture)) {
                $queryupdate = "UPDATE users SET image = '$picture' WHERE id= '$userid' ";
                $result = mysqli_query($conn, $queryupdate) or die(mysqli_error($conn));

                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>alert('Profile Photo uploaded successfully'); window.location.href= 'userprofile.php';</script>";
                } else {
                    echo "<script>alert('Error! ..try again');</script>";
                }
            } else {
                echo "<script>alert('Error occurred while uploading! ..try again');</script>";
            }
        }
    } else {
        $picture = $row['image'];
    }

    if (isset($_POST['update'])) {
        require "../gump.class.php";
        $gump = new GUMP();
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'name'   => 'required|alpha_space|max_len,30|min_len,2',
            'email'       => 'required|valid_email',
            'bio'    => 'max_len,150',
            'currentpassword' => 'required|max_len,50|min_len,6',
            'newpassword'    => 'max_len,50|min_len,6',
        ));

        $gump->filter_rules(array(
            'name' => 'trim|sanitize_string',
            'currentpassword' => 'trim',
            'newpassword' => 'trim',
            'email'    => 'trim|sanitize_email',
            'bio' => 'trim',
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            echo "<center><font color='red'>" . $gump->get_readable_errors(true) . "</font></center>";
        } elseif (!password_verify($validated_data['currentpassword'], $userpassword)) {
            echo  "<center><font color='red'>Current password is wrong! </font></center>";
        } elseif (empty($_POST['newpassword'])) {
            $name = $validated_data['name'];
            $useremail = $validated_data['email'];
            $userbio = $validated_data['bio'];
            $updatequery1 = "UPDATE users SET name = '$name' , email='$useremail' , about='$userbio' WHERE id = '$userid' ";
            $result2 = mysqli_query($conn, $updatequery1) or die(mysqli_error($conn));

            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('PROFILE UPDATED SUCCESSFULLY'); window.location.href='userprofile.php';</script>";
            } else {
                echo "<script>alert('An error occurred, Try again!');</script>";
            }
        } elseif (isset($_POST['newpassword']) &&  ($_POST['newpassword'] !== $_POST['confirmnewpassword'])) {
            echo  "<center><font color='red'>New password and Confirm New password do not match </font></center>";
        } else {
            $name = $validated_data['name'];
            $useremail = $validated_data['email'];
            $pass = $validated_data['newpassword'];
            $userpassword = password_hash("$pass", PASSWORD_DEFAULT);

            $updatequery = "UPDATE users SET password = '$userpassword', name='$name', email= '$useremail' WHERE id='$userid'";
            $result1 = mysqli_query($conn, $updatequery) or die(mysqli_error($conn));

            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('PROFILE UPDATED SUCCESSFULLY'); window.location.href='userprofile.php';</script>";
            } else {
                echo "<script>alert('An error occurred, Try again!');</script>";
            }
        }
    }
}
?>

<div id="wrapper">
    <?php include 'includes/adminnav.php'; ?>
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div>
                    <h1 class="page-header">
                        Welcome to your profile
                        <span><?php echo $_SESSION['name']; ?></span>
                    </h1>

                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 d-flex flex-column gap-2">
                            <img class="img-thumbnail" width="200" src="profilepics/<?php echo $picture; ?>" alt="Photo">
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" name="uploadphoto" class="btn btn-primary">
                            Upload Photo
                        </button>
                    </form>

                    <form role="form" action="" method="POST" enctype="multipart/form-data">
                        <hr>
                        <div class="mb-3">
                            <label for="user_title" class="form-label">User Name</label>
                            <input type="text" name="username" class="form-control" value=" <?php echo $username; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="user_author" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_tag" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $useremail; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="post_content" class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" id="" cols="30" rows="10"><?php echo $bio;  ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="usertag" class="form-label">Current Password</label>
                            <input type="password" name="currentpassword" class="form-control" placeholder="Enter Current password" required>
                        </div>
                        <div class="mb-3">
                            <label for="usertag" class="form-label">New Password <font color='brown'> (changing password is optional)</font></label>
                            <input type="password" name="newpassword" class="form-control" placeholder="Enter New Password">
                        </div>
                        <div class="mb-3">
                            <label for="usertag" class="form-label">Confirm New Password</label>
                            <input type="password" name="confirmnewpassword" class="form-control" placeholder="Re-Enter New Password">
                        </div>
                        <hr>
                        <button type="submit" name="update" class="btn btn-primary">Update User</button>
                    </form>
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