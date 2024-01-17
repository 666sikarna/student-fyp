<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<link rel="stylesheet" type="text/css" href="styles.css" medxia="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "fade"
        });

        $(function() {
            $('.show_menu').click(function() {
                $('.menu').fadeIn();
                $('.show_menu').fadeOut();
                $('.hide_menu').fadeIn();
            });
            $('.hide_menu').click(function() {
                $('.menu').fadeOut();
                $('.show_menu').fadeIn();
                $('.hide_menu').fadeOut();
            });
        });
    });
</script>

<div>
    <div class="slider_container">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <a href="#"><img src="images/slider/slide1.jpg" alt="" title="" /></a>
                    <div class="flex-caption">
                        <div class="caption_title_line">
                            <h2>Easy Notes Management</h2>
                            <p>Now easily manage all kind of notes by uploading them here.</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/slide2.jpg" alt="" title="" /></a>
                    <div class="flex-caption">
                        <div class="caption_title_line">
                            <h2>Upload Various Files</h2>
                            <p>User can upload various types of files like PDF, PPT, DOC etc..</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/slide3.jpg" alt="" title="" /></a>
                    <div class="flex-caption">
                        <div class="caption_title_line">
                            <h2>Controled By Admin</h2>
                            <p>Everying is managed and controled by administrator</p>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#"><img src="images/slider/slide4.jpg" alt="" title="" /></a>
                    <div class="flex-caption">
                        <div class="caption_title_line">
                            <h2>Login For Both Teacher and Student</h2>
                            <p>Both teacher and student can login and upload notes </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">
                        <img src="images/slider/slide2.jpg" alt="" title="" /></text>
                </svg>
            </div>
            <div class="carousel-item active">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text>
                </svg>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text>
                </svg>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section class="container mt-5" style="padding: 10px 40px;">
        <div class="row">
            <div class="d-flex flex-wrap mx-auto">
                <div>
                    <h3 class="mt-4" style="font-size: 20px;">About Us</h3>
                    <p style="margin-top: 10px;">Welcome to <strong>College Notes Gallery</strong>, where studying meets simplicity. We understand the challenges
                        students face in organizing and managing their notes effectively. That's why we've created a platform dedicated
                        to making the note-taking process seamless and efficient.</p>
                </div>

                <div style="margin: 20px 0 0 0;">
                    <h3 class="mt-4" style="font-size: 20px;">Our Mission</h3>
                    <p style="margin-top: 10px;">At <strong>College Notes Gallery</strong>, our mission is to empower students by providing a user-friendly and
                        feature-rich environment for collecting, organizing, and accessing their study materials. We believe that a
                        well-organized set of notes can significantly enhance the learning experience.</p>
                </div>

                <div style="margin: 20px 0 0 0;">
                    <h3 class="mt-4" style="font-size: 20px;">Meet the Team</h3>
                    <p style="margin-top: 10px;"><strong>Your Name</strong> - Founder and Lead Developer<br>
                        With a passion for software development and a background in [Your Specialization], I envisioned a platform
                        that would revolutionize how students manage their study materials. At <strong>College Notes Gallery</strong>,
                        we're committed to continuous improvement and innovation.</p>
                </div>


                <div>

                    <p style="margin-top: 10px; font-size: 20px;">Join us on the learning journey. Start collecting notes with <strong>College Notes Gallery</strong> today!</p>
                </div>

            </div>
        </div>
</div>
</section>