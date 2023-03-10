<!-- Developed by Jake Napay -->
<!-- github:https://github.com/jakenapay/Online-Salon-Booking-System -->
<?php
session_start();

if (isset($_GET['b']) and ($_GET['b'] != '')) {
    echo '<script>
    alert("Booking success!");</script>';
}
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
                    <h1 class="nav-logo">Test_logo </h1>
                </a>
                <ul class="menu">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php" class="msg-btn">Services</a></li>
                    <?php
                    if (isset($_SESSION['id']) and ($_SESSION['id']) != '') {
                        echo '<li><a href="profile.php">Profile</a></li>';
                        if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                            echo '<li><a href="books.php">Bookings</a></li>';
                        }
                        echo '<li><a href="process/logout.inc.php">Logout</a></li>';
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
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php" class="msg-btn">Services</a></li>
            <?php
            if (isset($_SESSION['id']) and ($_SESSION['id']) != '') {
                echo '<li><a href="profile.php">Profile</a></li>';
                if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                    echo '<li><a href="books.php">Bookings</a></li>';
                }
                echo '<li><a href="process/logout.inc.php">Logout</a></li>';
            }
            ?>
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
        <p>Your ID: </p>
    </div> -->
    <section id="header">
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <h3>Welcome to Salon Booking</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, nihil eveniet! Harum asperiores fuga libero inventore ad vero molestiae mollitia.</p>
                    </div>
                    <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                        <img src="" alt="">
                    </div> -->
                </div>
            </div>
        </main>
    </section>

    <!-- Short info about your website -->
    <section id="about">

    </section>

    <section id="service">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <h3 class="section-title">Services</h3>

                <?php
                include 'process/config.inc.php';
                $sql = "SELECT * FROM salon.service LIMIT 3";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['service_id'];
                        $name = $row['service_name'];
                        $price = $row['service_price'];
                        $description = $row['service_desc'];
                        $info = $row['service_more_info'];
                ?>
                        <div class="col-sm-12 col-sm-4 col-lg-3 service-box">

                            <div class="service">
                                <h3 class="service-name">
                                    <?php echo $name; ?>
                                </h3>
                                <p class="service-price">Starts at <?php echo $price; ?></p>
                                <p class="service-description ellipsis">
                                    <?php echo $description; ?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="serviceView.php?service_id=<?php echo $id; ?>">View</a>
                                    <?php
                                    if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                                        if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                                            echo '<a href="serviceEdit.php?service_id=' . $id . '">Edit</a>';
                                            echo '<a href="services.php?del_service_id=' . $id . '">Delete</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                <?php
                    }
                } else {
                    echo "0 results";
                }
                ?>

                <a href="services.php" class="text-center">See more</a>
            </div>

        </div>
        </div>
    </section>

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
</body>

</html>