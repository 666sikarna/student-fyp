<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-2">
    <div class="container">

        <a class="navbar-brand" href="index">Study Sidekick
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <span> - Admin</span>
            <?php } ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($_SESSION['role'] !== 'admin') { ?>

                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="index" class="active">
                        <i class="fa fa-fw fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>

                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="dropdown nav-item">
                        <div class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-list-check"></i>
                            Action
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownNotes">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="./users.php">
                                <div class="d-flex align-items-center">
                                    View Users
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="./questions.php">
                                <div class="d-flex align-items-center">
                                    View Questions
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="./add_question.php">
                                <div class="d-flex align-items-center">
                                    Add Question
                                </div>
                            </a>
                            <a class="dropdown-item" href="./videos.php">
                                View Videos
                            </a>
                            <a class="dropdown-item" href="./uploadvideos.php">
                                <div class="d-flex align-items-center">
                                    Upload Video
                                </div>
                            </a>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownNotes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-note-sticky"></i>
                            My Notes
                        </a>
                        <ul class="dropdown-menu aria-labelledby=" navbarDropdownNotes">
                            <a class="dropdown-item" href="./notes.php">
                                View All Notes
                            </a>
                            <a class="dropdown-item" href="./uploadnote.php">
                                Upload Note
                            </a>
                        </ul>
                    </li>
                <?php } ?>
                <li class="dropdown" style="width: 150px;">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <span class="text-capitalize">
                            Profile
                        </span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                        <a class="dropdown-item" href="./viewprofile.php?name=<?php echo $_SESSION['username']; ?>">
                            <i class="fa-solid fa-eye"></i>
                            View
                        </a>
                        <a class="dropdown-item" href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>
                        <a class="dropdown-item" href="../logout.php">
                            <i class="fa fa-fw fa-power-off"></i>
                            Log Out
                        </a>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>