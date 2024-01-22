<?php include 'includes/connection.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>College Notes Gallery | Homepage</title>
</head>

<body>
	<div class="container">
		<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/slider/slide1.jpg" class="d-block w-100" alt="Slide 1">
					<div class="">
						<h2 class="text-dark">Easy Notes Management</h2>
						<p>Now easily manage all kinds of notes by uploading them here.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/slider/slide2.jpg" class="d-block w-100" alt="Slide 2">
					<div class="">
						<h2>Upload Various Files</h2>
						<p>Users can upload various types of files like PDF, PPT, DOC, etc.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/slider/slide3.jpg" class="d-block w-100" alt="Slide 3">
					<div class="">
						<h2>Controlled By Admin</h2>
						<p>Everything is managed and controlled by the administrator.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/slider/slide4.jpg" class="d-block w-100" alt="Slide 4">
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
	</div>
</body>

</html>








































<?php include 'includes/footer.php'; ?>