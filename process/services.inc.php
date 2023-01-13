<?php

if (isset($_POST['insertNewService'])) {

    include 'config.inc.php';

    $name = $_POST['service_name'];
    $description = $_POST['service_desc'];
    $price = $_POST['service_price'];
    $info = $_POST['service_more_info'];

    $sql = "INSERT INTO salon.service (service_name, service_price, service_desc, service_more_info, date_added) VALUES ('$name', '$price', '$description', '$info', now())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New record created successfully');window.location.replace('../services.php');
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
