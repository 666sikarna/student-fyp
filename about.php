<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<link rel="stylesheet" type="text/css" href="styles.css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(document).ready(function() {
        $('.flexslider').flexslider({
            animation: "fade"
        });
    });
</script>

<div class="container">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider/slide5.jpg" class="d-block w-100" alt="Slide 1">
                <div class="">
                    <h2 class="text-dark">Easy Notes Management</h2>
                    <p>Now easily manage all kinds of notes by uploading them here.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/slider/slide6.jpg" class="d-block w-100" alt="Slide 2">
                <div class="">
                    <h2>Upload Various Files</h2>
                    <p>Users can upload various types of files like PDF, PPT, DOC, etc.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/slider/slide7.jpg" class="d-block w-100" alt="Slide 3">
                <div class="">
                    <h2>Controlled By Admin</h2>
                    <p>Everything is managed and controlled by the administrator.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/slider/slide8.jpg" class="d-block w-100" alt="Slide 4">
                <div class="">
                    <h2>Login For Both Teacher and Student</h2>
                    <p>Both teachers and students can log in and upload notes.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="container mt-5" style="padding: 10px 40px;">
        <div class="row">
            <div class="d-flex flex-wrap mx-auto">
                <div>
                    <h3 class="mt-4" style="font-size: 20px;">About Us</h3>
                    <p style="margin-top: 10px;">Welcome to <strong>Study Sidekick</strong>, where studying meets simplicity. We understand the challenges
                        students face in organizing and managing their notes effectively. That's why we've created a platform dedicated
                        to making the note-taking process seamless and efficient.</p>
                </div>

                <div style="margin: 20px 0 0 0;">
                    <h3 class="mt-4" style="font-size: 20px;">Our Mission</h3>
                    <p style="margin-top: 10px;">At <strong>Study Sidekick</strong>, our mission is to empower students by providing a user-friendly and
                        feature-rich environment for collecting, organizing, and accessing their study materials. We believe that a
                        well-organized set of notes can significantly enhance the learning experience.</p>
                </div>

                <div style="margin: 20px 0 0 0;">
                    <h3 class="mt-4" style="font-size: 20px;">Meet the Team</h3>
                    <p style="margin-top: 10px;"><strong>Muhammad Hasiif Bin Mohammad Jamil</strong> - Founder and Lead Developer<br>
                        With a passion for software development and a background in [Your Specialization], I envisioned a platform
                        that would revolutionize how students manage their study materials. At <strong>Study Sidekick</strong>,
                        we're committed to continuous improvement and innovation.</p>
                </div>


                <div>

                    <p style="margin-top: 10px; font-size: 20px;">Join us on the learning journey. Start collecting notes with <strong>Study Sidekick</strong> today!</p>
                </div>

            </div>
        </div>
    </section>
</div>