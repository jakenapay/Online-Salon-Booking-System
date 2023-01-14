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
    <link rel="stylesheet" href="assets/css/serviceEdit.css?v=<?php echo time(); ?>">
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
                            echo '<li><a href="books.php" class="">Bookings</a></li>';
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
                    echo '<li><a href="books.php" class="">Bookings</a></li>';
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

    <section id="serviceEdit">
        <div class="container">
            <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <?php
                    if (isset($_GET['service_id']) and ($_GET['service_id']) != '') {
                        $sid = $_GET['service_id'];

                        include 'process/config.inc.php';
                        $sql = "SELECT * FROM salon.service WHERE service_id='$sid' LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $sid = $row['service_id'];
                                $sname = $row['service_name'];
                                $sprice = $row['service_price'];
                                $sdesc = $row['service_desc'];
                                $sinfo = $row['service_more_info'];
                    ?>
                                <form method="post" action="process/services.inc.php">
                                    <!-- service name -->
                                    <h2 class="text-center mb-1">Edit Service</h2>
                                    <input type="hidden" class="form-control" id="service_id" name="service_id" value="<?php echo $sid; ?>" placeholder="service id">

                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control" id="service_name" name="service_name" value="<?php echo $sname; ?>" placeholder="Service Name" required>
                                    </div>
                                    <!-- service price -->
                                    <div class="form-group">
                                        <label for="service_price">Example select</label>
                                        <input type="number" class="form-control" id="service_price" name="service_price" value="<?php echo $sprice; ?>" min="0" required placeholder="Service Price">
                                    </div>
                                    <!-- service desc -->
                                    <div class="form-group">
                                        <label for="service_desc">Service Description</label>
                                        <textarea class="form-control" id="service_desc" name="service_desc" rows="3"><?php echo $sdesc; ?></textarea>
                                    </div>
                                    <!-- service mroe info -->
                                    <div class="form-group">
                                        <label for="service_more_info">More Information</label>
                                        <textarea class="form-control" id="service_more_info" name="service_more_info" rows="3"><?php echo $sinfo; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript:history.back()" class="btn btn-danger">Back</a>
                                        <button type="submit" name="update" id="update" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                    <?php
                            }
                        } else {
                            echo "0 results";
                        }
                    } else {
                        header("location: javascript:history.back()");
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>


    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
</body>

</html>