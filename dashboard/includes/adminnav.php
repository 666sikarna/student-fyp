<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index">COLLEGE NOTES GALLERY</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($_SESSION['role'] !== 'admin') { ?>
                    <li class="nav-item"><a class="nav-link" href="./uploadnote.php">Upload</a></li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> <?php echo $_SESSION['name']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>"><i class="fa fa-fw fa-user"></i> Account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index" class="active"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:;" data-bs-toggle="collapse" data-bs-target="#user"><i class="fa fa-fw fa-users"></i>
                            Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="user" class="collapse">
                            <li><a class="nav-link" href="./users.php">View All Users</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" href="javascript:;" data-bs-toggle="collapse" data-bs-target="#posts"><i class="fa fa-fw fa-file-text"></i> My Account <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="posts" class="dropdown-menu">
                                <li><a class="nav-link" href="./viewprofile.php?name=<?php echo $_SESSION['username']; ?>">View Profile</a></li>
                                <li><a class="nav-link" href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>">Edit Profile</a></li>
                            </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <button class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My Notes
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="./notes.php">
                                    View All Notes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./uploadnote.php">
                                    Upload Note
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <button class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="./viewprofile.php?name=<?php echo $_SESSION['username']; ?>">
                                    View Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>">
                                    Edit Profile
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>