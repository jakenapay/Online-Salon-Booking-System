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
    <link rel="stylesheet" href="assets/css/serviceView.css?v=<?php echo time(); ?>">
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
                echo '<li><a href="process/logout.inc.php">Logout</a></li>';
            }
            ?>
        </ul>
    </nav>


    <section id="header">
        <main>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <?php
                        if (isset($_GET['service_id']) and ($_GET['service_id']) != '') {
                            include 'process/config.inc.php';
                            $sId = $_GET['service_id'];
                            $sql = "SELECT * FROM salon.service WHERE service_id='$sId' LIMIT 1";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    $sId = $row['service_id'];
                                    $sName = $row['service_name'];
                                    $sPrice = $row['service_price'];
                                    $sDesc = $row['service_desc'];
                                    $sInfo = $row['service_more_info'];
                                    $sDate = $row['date_added'];

                        ?>

                                    <!-- <h3 class=""><?php echo $sId; ?></h3> -->
                                    <h2 class=""><?php echo $sName; ?></h2>
                                    <p class="service-price"><?php echo "Starts at " . $sPrice . ""; ?></p>
                                    <br>
                                    <h5>Description</h5>
                                    <p class="service-info"><?php echo "Description: " . $sDesc; ?></p>
                                    <br>
                                    <h5>More information</h5>
                                    <p class="service-info"><?php echo $sInfo; ?></p>
                                    <br>


                                    <?php
                                    if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                                    ?>
                                        <form action="process/book.inc.php" method="post">
                                            <input type="hidden" id="service_id" name="service_id" value="<?php echo $sId; ?>">
                                            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                            <button name="book" id="book" type="submit">Book Now</button><br><br>
                                            <a href="javascript:history.back()">back</a>
                                        </form>
                                    <?php
                                    }
                                    ?>



                        <?php
                                }
                            } else {
                                echo "0 results";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </section>


    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
</body>

</html>