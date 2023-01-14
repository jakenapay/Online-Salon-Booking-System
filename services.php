<?php
session_start();

if (isset($_GET['del_service_id']) and ($_GET['del_service_id'] != '')) {

    include 'process/config.inc.php';
    $id = $_GET['del_service_id'];

    $sql = "DELETE FROM salon.service WHERE service_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
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
    <link rel="stylesheet" href="assets/css/services.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav class="nav">
            <div class="container-nav">
                <a href="index.html" style="text-decoration: none;">
                    <h1 class="nav-logo">Test_logo </h1>
                </a>
                <ul class="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php" class="active">Services</a></li>
                    <?php
                    if (isset($_SESSION['id']) and ($_SESSION['id']) != '') {
                        echo '<li><a href="profile.php" class="msg-btn">Profile</a></li>';
                        if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                            echo '<li><a href="books.php">Bookings</a></li>';
                        }
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php" class="active">Services</a></li>
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

    <section id="service">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <h3 class="section-title">Services</h3>

                <?php
                if (isset($_SESSION['id']) and ($_SESSION['id'] != '')) {
                    if (isset($_SESSION['typ']) and ($_SESSION['typ'] != 'user')) {
                        echo '<span>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertNewServiceModal">
                                    Add New Service
                                </button>
                            </span>';
                    }
                }
                ?>


                <?php
                include 'process/config.inc.php';
                $sql = "SELECT * FROM salon.service";
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

                <div class="text-center mt-3">

                    <!-- modal for insert new service -->
                    <!-- Modal -->
                    <div class="modal fade" id="insertNewServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="process/services.inc.php" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- service_name -->
                                        <div class="form-group">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" class="form-control" id="service_name" name="service_name" required>
                                        </div>

                                        <!-- service price -->
                                        <div clas="form-group">
                                            <label for="service_price">Service Price</label>
                                            <input type="number" class="form-control" id="service_price" name="service_price" min="0" required>
                                        </div>

                                        <!-- service_description -->
                                        <div class="form-group">
                                            <label for="service_desc">Service Description</label>
                                            <textarea class="form-control" id="service_desc" name="service_desc" rows="3" required></textarea>
                                        </div>

                                        <!-- service_more_information -->
                                        <div class="form-group">
                                            <label for="service_more_info">More Information</label>
                                            <textarea class="form-control" id="service_more_info" name="service_more_info" rows="3" required></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" id="insertNewService" name="insertNewService" class="btn btn-primary" value="Save Changes">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>