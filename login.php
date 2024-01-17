<?php
include 'includes/connection.php';

session_start();
if (isset($_POST['login'])) {
  $username  = $_POST['user'];
  $password = $_POST['pass'];
  mysqli_real_escape_string($conn, $username);
  mysqli_real_escape_string($conn, $password);
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $user = $row['username'];
      $pass = $row['password'];
      $name = $row['name'];
      $email = $row['email'];
      $role = $row['role'];
      $course = $row['course'];
      if (password_verify($password, $pass)) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['email']  = $email;
        $_SESSION['role'] = $role;
        $_SESSION['course'] = $course;
        header('location: dashboard/');
      } else {
        echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";
      }
    }
  } else {
    echo "<script>alert('invalid username/password');
      window.location.href='login.php';</script>";
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

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title text-center">Login</h1>
            <form method="POST" style="margin-top: 20px;">
              <div class="mb-3">
                <input type="text" name="user" class="form-control" placeholder="Username" required="">
              </div>
              <div class="mb-3">
                <input type="password" name="pass" class="form-control" placeholder="Password" required="">
              </div>
              <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="mt-3 text-center">
              <a href="signup.php">Register</a> • <a href="recoverpassword.php">Forgot Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>