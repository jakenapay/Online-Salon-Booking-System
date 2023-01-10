<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- stylesheet for index -->
    <!-- dont remove the php line -->
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/navbar.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav class="nav">
            <div class="container-nav">
                <a href="index.html" style="text-decoration: none;">
                    <h1 class="nav-logo">TANGINAMO BRIAN</h1>
                </a>
                <ul class="menu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php" class="msg-btn">Services</a></li>
                    <?php
                    if (isset($_SESSION['id']) and ($_SESSION['id']) != '') {
                        echo '<li><a href="profile.php" class="msg-btn">Profile</a></li>';
                        echo '<li><a href="process/logout.inc.php" class="msg-btn">Logout</a></li>';
                    }
                    ?>
                </ul>

                <button class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
    </header>
    <nav class="mobile-nav">
        <ul>
            <li><a href="index.html" class="active">About</a></li>
            <li><a href="projects.html">Projects</a></li>
            <li><a href="index.html#section-five">Message</a></li>
        </ul>
    </nav>
    <!-- end of navigation bar -->

    <!-- start of contents  -->
    <!-- <div class="container">
        <p>Hi! Your name is <?php
                            if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                                echo $_SESSION['fn'] . " " . $_SESSION['ln'];
                            } else {
                                header("location: login.php");
                            }
                            ?>
        </p>
        <p>Your ID: <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                        echo $_SESSION['id'];
                    }
                    ?></p>
    </div> -->
    <section id="header">
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <h4></h4>
                    </div>
                    <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                        <img src="" alt="">
                    </div> -->
                </div>
            </div>
        </main>
    </section>


    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
</body>

</html>