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
    <!-- <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>"> -->
    <link rel="stylesheet" href="assets/css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/books.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav class="nav">
            <div class="container-nav">
                <a href="index.html" style="text-decoration: none;">
                    <h1 class="nav-logo">Test_logo</h1>
                </a>
                <ul class="menu">
                    <li><a href="index.php" class="">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php" class="">Services</a></li>
                    <?php
                    if (isset($_SESSION['id']) and ($_SESSION['id']) != '') {
                        echo '<li><a href="profile.php">Profile</a></li>';
                        if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                            echo '<li><a href="books.php" class="active">Bookings</a></li>';
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
                    echo '<li><a href="books.php" class="active">Bookings</a></li>';
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
        <p>Your ID: <?php if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                        echo $_SESSION['id'];
                    }
                    ?></p>
    </div> -->

    <section id="bookings">
        <div class="container">
            <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center bookings">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <table class="table text-center">
                        <h2 class="text-center mb-5">Bookings</h2>
                        <thead>
                            <tr>
                                <th scope="col">Booking ID</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Service Name</th>
                                <th scope="col">Book Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include 'process/config.inc.php';

                            $sql = "SELECT b.booking_id, CONCAT(u.first_name, ' ', u.last_name) AS fullname, s.service_name, b.book_date FROM salon.bookings AS b INNER JOIN salon.users AS u ON b.user_id=u.id INNER JOIN salon.service AS s ON b.service_id=s.service_id;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $bid = $row['booking_id'];
                                    $uname = $row['fullname'];
                                    $sname = $row['service_name'];
                                    $bdate = $row['book_date'];

                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $bid; ?></th>
                                        <td><?php echo $uname; ?></td>
                                        <td><?php echo $sname; ?></td>
                                        <td><?php echo $bdate; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
</body>

</html>