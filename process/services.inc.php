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


if (isset($_POST['update'])) {
    include 'config.inc.php';

    $sid = $_POST['service_id'];
    $sname = $_POST['service_name'];
    $sprice = $_POST['service_price'];
    $sdesc = $_POST['service_desc'];
    $sinfo = $_POST['service_more_info'];

    $sql = "UPDATE salon.service SET service_name='$sname', service_price='$sprice', service_desc='$sdesc', service_more_info='$sinfo' WHERE service_id='$sid'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Edit success");window.location.replace("../services.php")</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
