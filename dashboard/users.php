<?php
// Include necessary files
global $conn;
include('includes/connection.php');
include "includes/adminheader.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "includes/adminnav.php"; ?>
    <?php
    if ($_SESSION['role'] == 'admin') {
    ?>
        <div class="container mt-4 w-100">
            <h3>All Users</h3>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Course</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch users from the database
                    $query = "SELECT * FROM users ORDER BY name ASC";
                    $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));

                    if (mysqli_num_rows($select_users) > 0) {
                        while ($row = mysqli_fetch_array($select_users)) {
                            // Extract user data
                            $user_id = $row['id'];
                            $username = $row['username'];
                            $name = $row['name'];
                            $user_email = $row['email'];
                            $user_role = $row['role'];
                            $user_course = $row['course'];

                            // Display user data in table rows
                            echo "<tr>";
                            echo "<td>$user_id</td>";
                            echo "<td><a href='viewprofile.php?name=$username' target='_blank'>$username</a></td>";
                            echo "<td>$name</td>";
                            echo "<td>$user_email</td>";
                            echo "<td class='capitalize'>$user_role</td>";
                            echo "<td class='capitalize'>$user_course</td>";
                            echo "<td><a class='btn btn-danger btn-sm' onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-trash'></i> Delete</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php
            // Handle user deletion
            if (isset($_GET['delete'])) {
                $the_user_id = mysqli_real_escape_string($conn, $_GET['delete']);
                $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
                $result = mysqli_query($conn, $query0) or die(mysqli_error($conn));

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $id1 = $row['role'];

                    // Check if the user to be deleted is an admin
                    if ($id1 == 'admin') {
                        echo "<script>alert('Admin cannot be deleted');</script>";
                    } else {
                        // Delete the user
                        $query = "DELETE FROM users WHERE id = '$the_user_id'";
                        $delete_query = mysqli_query($conn, $query) or die(mysqli_error($conn));

                        // Check if the deletion was successful
                        if (mysqli_affected_rows($conn) > 0) {
                            echo "<script>alert('User deleted successfully'); window.location.href= 'users.php';</script>";
                        } else {
                            echo "<script>alert('Error'); window.location.href= 'users.php';</script>";
                        }
                    }
                }
            }
            ?>
        </div>

        <style>
            .capitalize {
                text-transform: capitalize;
            }
        </style>

    <?php
    } else {
        // Redirect to the index page if the user is not an admin
        header("location: index.php");
    }
    ?>
</body>

</html>