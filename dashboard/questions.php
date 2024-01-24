<?php include 'includes/connection.php'; ?>
<?php include 'includes/adminheader.php';
?>

<?php
if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
    header("location: index.php");
}
?>


<?php

if (isset($_GET['del'])) {
    $question_id = mysqli_real_escape_string($conn, $_GET['del']);
    $file_uploader = $_SESSION['username'];

    $query = "DELETE FROM questions WHERE question_id='$question_id'";

    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Note deleted successfully');
        window.location.href='notes.php';</script>";
    } else {
        echo "<script>alert('error occured.try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <style>

    </style>
</head>

<body>
    <?php include 'includes/adminnav.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <h3>Questions</h3>
            <div class="col-xs-4">
                <a href="add_question.php" class="btn btn-primary">Add New Question</a>
            </div>
        </div>
        <div class="mt-4">
            <form action="" method="post">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Uploaded on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $currentuser = $_SESSION['id'];

                        $query = "SELECT * FROM questions;";

                        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));

                        if (mysqli_num_rows($run_query) > 0) {
                            while ($row = mysqli_fetch_array($run_query)) {
                                $question_id = $row['question_id'];
                                $question_name = $row['question_name'];
                                $question_description = $row['question_description'];
                                $file_type = $row['file_type'];
                                $file_date = $row['upload_time'];
                                $file = $row['file'];
                        ?>
                                <tr>
                                    <td><?php echo $question_name; ?></td>
                                    <td><?php echo $question_description; ?></td>
                                    <td><?php echo $file_type; ?></td>
                                    <td><?php echo $file_date; ?></td>
                                    <td>
                                        <a class='btn btn-sm btn-primary' href='#' onclick="displayPdf('allfiles/<?php echo $file; ?>', '<?php echo $file; ?>')" target='_blank'>
                                            View
                                        </a>
                                        <a class='btn btn-sm btn-primary' href="allfiles/<?php echo $file; ?>" target='_blank' download>
                                            Download
                                        </a>
                                        <a class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this post?')" href="?del=<?php echo $question_id; ?>">
                                            <i class='fa fa-trash' style='color: white;'>
                                            </i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div>
                                Not question found! Start uploding now.
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script>
        function displayPdf(file_path, file_name) {
            window.open('view_pdf.php?file_path=' + encodeURIComponent(file_path) + '&file_name=' + encodeURIComponent(file_name), '_blank');
        }
    </script>
</body>

</html>