<?php
include 'includes/connection.php';
include 'includes/adminheader.php';


function getSubjects($conn)
{
    $query = "SELECT subject_name, subject_id FROM subject"; // Change the table name accordingly
    $result = mysqli_query($conn, $query);

    $subjects = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subject = new stdClass();
        $subject->subject_id = $row['subject_id'];
        $subject->subject_name = $row['subject_name'];
        $subjects[] = $subject;
    }

    return $subjects;
}

if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
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
        'link'   => 'required|max_len,150|min_len,3',
    ));
    $gump->filter_rules(array(
        'title' => 'trim|sanitize_string',
        'description' => 'trim|sanitize_string',
        'link' => 'trim|sanitize_string',
    ));
    $validated_data = $gump->run($_POST);

    if ($validated_data === false) {
        $video_title = $_POST['title'];
        $video_description = $_POST['description'];
        $video_link = $_POST['link'];
        $subject_id = $_POST['subject'];
    } else {
        $video_title = $validated_data['title'];
        $video_description = $validated_data['description'];
        $video_link = $validated_data['link'];
        $subject_id = $validated_data['subject'];

        if (isset($_SESSION['id'])) {
            $file_uploader = $_SESSION['username'];
            $file_uploaded_to = $_SESSION['course'];
            $user_id = $_SESSION['id'];
        }

        $query = "INSERT INTO videos (
                    video_name, 
                    video_description, 
                    url, 
                    status, 
                    file_uploader, 
                    subject_id)
                VALUES (
                    '$video_title',
                    '$video_description',
                    '$video_link',
                    'pending',
                    '$user_id',
                    '$subject_id')";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script> alert('file uploaded successfully.It will be published after admin approves it');
                    window.location.href='notes.php';</script>";
        } else {
            "<script> alert('Error while uploading..try again');</script>";
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


</head>

<body>
    <?php include 'includes/adminnav.php'; ?>
    <div class="container mt-4">
        <h1>Upload Video</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="form-wrapper">
            <div class="form-group">
                <label for="title" class="form-label">Video Title</label>
                <input type="text" name="title" class="form-control" placeholder="Php Tutorial File" value="<?= isset($_POST['upload']) ? $file_title : '' ?>" required />
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Short Video Description</label>
                <input type="text" name="description" class="form-control" placeholder="Php Tutorial File includes basic php programming ...." value="<?= isset($_POST['upload']) ? $file_description : '' ?>" required />
            </div>
            <div>
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select form-select" name="subject" required onchange="console.log(value)">
                    <?php
                    $subjects = getSubjects($conn);
                    foreach ($subjects as $subject) {
                        echo "<option value='$subject->subject_id'>$subject->subject_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="" />
                <small id="helpId" class="form-text text-muted">URL to stream the content</small>
            </div>



            <div style="display: flex; justify-content: center;">
                <button type="submit" name="upload" class="btn btn-primary">Upload Video</button>
            </div>
        </form>
    </div>

    <style>
        .form-wrapper {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .submit-btn {
            width: 140px;
        }
    </style>
</body>

</html>