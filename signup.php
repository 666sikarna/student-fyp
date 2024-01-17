<?php include 'includes/connection.php'; ?>

<?php
if (isset($_POST['signup'])) {
    require "gump.class.php";
    $gump = new GUMP();
    $_POST = $gump->sanitize($_POST);

    $gump->validation_rules(array(
        'username'    => 'required|alpha_numeric|max_len,20|min_len,4',
        'name'        => 'required|alpha_space|max_len,30|min_len,5',
        'email'       => 'required|valid_email',
        'password'    => 'required|max_len,50|min_len,6',
    ));
    $gump->filter_rules(array(
        'username' => 'trim|sanitize_string',
        'name'     => 'trim|sanitize_string',
        'password' => 'trim',
        'email'    => 'trim|sanitize_email',
    ));
    $validated_data = $gump->run($_POST);

    if ($validated_data === false) {
?>
        <center>
            <font color="red"> <?php echo $gump->get_readable_errors(true); ?> </font>
        </center>
<?php
    } elseif ($_POST['password'] !== $_POST['repassword']) {
        echo  "<center><font color='red'>Passwords do not match </font></center>";
    } else {
        $username = $validated_data['username'];
        $checkusername = "SELECT * FROM users WHERE username = '$username'";
        $run_check = mysqli_query($conn, $checkusername) or die(mysqli_error($conn));
        $countusername = mysqli_num_rows($run_check);
        if ($countusername > 0) {
            echo  "<center><font color='red'>Username is already taken! try a different one</font></center>";
        }
        $email = $validated_data['email'];
        $checkemail = "SELECT * FROM users WHERE email = '$email'";
        $run_check = mysqli_query($conn, $checkemail) or die(mysqli_error($conn));
        $countemail = mysqli_num_rows($run_check);
        if ($countemail > 0) {
            echo  "<center><font color='red'>Email is already taken! try a different one</font></center>";
        } else {
            $name = $validated_data['name'];
            $email = $validated_data['email'];
            $pass = $validated_data['password'];
            $password = password_hash("$pass", PASSWORD_DEFAULT);
            $role = $_POST['role'];
            $course = $_POST['course'];
            $gender = $_POST['gender'];
            $joindate = date("F j, Y");
            $query = "INSERT INTO users(username,name,email,password,role,course,gender,joindate,token) VALUES ('$username' , '$name' , '$email', '$password' , '$role', '$course', '$gender' , '$joindate' , '' )";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('SUCCESSFULLY REGISTERED');
        window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error Occured');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/header.php'; ?>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container" style="padding: 0 120px;">
        <div class="form">
            <form id="contactform" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" placeholder="First and last name" required="" tabindex="1" type="text" class="form-control" value="
                    
                    <?php if (isset($_POST['signup'])) {
                        echo $_POST['name'];
                    } ?>">

                </div>

                <div class="mb-3">
                    <label for=s"email" class="form-label">Email</label>
                    <input id="email" name="email" placeholder="example@domain.com" required="" type="email" class="form-control" value="
                    
                    <?php if (isset($_POST['signup'])) {
                        echo $_POST['email'];
                    } ?>
                    ">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Create a username</label>
                    <input id="username" name="username" placeholder="username" required="" tabindex="2" type="text" class="form-control" value="
                    <?php if (isset($_POST['signup'])) {
                        echo $_POST['username'];
                    } ?>
                    ">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Create a password</label>
                    <input type="password" id="password" name="password" required="" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="repassword" class="form-label">Confirm your password</label>
                    <input type="password" id="repassword" name="repassword" required="" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">I am a..</label>
                    <select class="form-select" name="role">
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="course" class="form-label">I teach/study..</label>
                    <select class="form-select" name="course">
                        <option value="Computer Science">Computer Sc Engineering</option>
                        <option value="Electrical">Electrical Engineering</option>
                        <option value="Mechanical">Mechanical Engineering</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="signup" id="submit" tabindex="5" type="submit">Sign me up!</button>
            </form>
        </div>
    </div>
</body>

</html>