<?php
include 'includes/connection.php';
include 'includes/adminheader.php';

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    header("location: index.php");
    exit();
}

if (isset($_POST['upload'])) {
    require "../gump.class.php";
    $gump = new GUMP();
    $_POST = $gump->sanitize($_POST);

    $gump->validation_rules(array(
        'title'    => 'required|max_len,60|min_len,3',
        'description'   => 'required|max_len,150|min_len,3',
    ));
    $gump->filter_rules(array(
        'title' => 'trim|sanitize_string',
        'description' => 'trim|sanitize_string',
    ));
    $validated_data = $gump->run($_POST);

    if ($validated_data === false) {

        $file_title = $_POST['title'];
        $file_description = $_POST['description'];
    } else {
        $file_title = $validated_data['title'];
        $file_description = $validated_data['description'];
        if (isset($_SESSION['id'])) {
            $file_uploader = $_SESSION['username'];
            $file_uploaded_to = $_SESSION['course'];
        }

        $file = $_FILES['file']['name'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $validExt = array('pdf', 'txt', 'doc', 'docx', 'ppt', 'zip');
        if (empty($file)) {
            echo "<script>alert('Attach a file');</script>";
        } elseif ($_FILES['file']['size'] <= 0 || $_FILES['file']['size'] > 30720000) {
            echo "<script>alert('file size is not proper');</script>";
        } elseif (!in_array($ext, $validExt)) {
            echo "<script>alert('Not a valid file');</script>";
        } else {
            $folder  = 'allfiles/';
            $fileext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $notefile = rand(1000, 1000000) . '.' . $fileext;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $folder . $notefile)) {
                $query = "INSERT INTO uploads(file_name, file_description, file_type, file_uploader, file_uploaded_to, file) VALUES ('$file_title' , '$file_description' , '$fileext' , '$file_uploader' , '$file_uploaded_to' , '$notefile')";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script> alert('file uploaded successfully.It will be published after admin approves it');
                    window.location.href='notes.php';</script>";
                } else {
                    "<script> alert('Error while uploading..try again');</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .form-wrapper {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .submit-btn {
            width: 140px;
        }
    </style>
</head>

<body>
    <?php include 'includes/adminnav.php'; ?>
    <div class="container mt-4">
        <h1>Upload Note</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="form-wrapper">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" name="title" class="form-control" placeholder="Php Tutorial File" value="<?= isset($_POST['upload']) ? $file_title : '' ?>" required />
            </div>
            <div class="form-group">
                <label for="description">Short Note Description</label>
                <input type="text" name="description" class="form-control" placeholder="Php Tutorial File includes basic php programming ...." value="<?= isset($_POST['upload']) ? $file_description : '' ?>" required />
            </div>
            <div class="form-group">
                <label for="post_image">Select File</label>
                <input class="form-control" type="file" name="file">
            </div>
            <div style="display: flex; justify-content: center;">
                <button type="submit" name="upload" class="btn btn-primary">Upload Note</button>
            </div>
        </form>
    </div>
</body>

</html>