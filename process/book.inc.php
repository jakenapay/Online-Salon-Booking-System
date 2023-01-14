<?php

if (isset($_POST['book'])) {
    include 'config.inc.php';

    $sId = $_POST['service_id'];
    $uId = $_POST['user_id'];

    $sql = "SELECT * FROM salon.users WHERE id='$uId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $phone = $row['phone'];
        }
    } else {
        echo "0 results";
    }

    $sql = "SELECT * FROM salon.service WHERE service_id='$sId' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sname = $row['service_name'];
            $sprice = $row['service_price'];
        }
    } else {
        echo "0 results";
    }

    $sql = "INSERT INTO salon.bookings (user_id, service_id, book_date) VALUES ('$uId', '$sId', now())";
    if ($conn->query($sql) === TRUE) {
        header("location: ../index.php?b=done");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
