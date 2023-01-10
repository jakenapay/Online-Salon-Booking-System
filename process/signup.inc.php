<?php

if (isset($_POST['signup'])) {

    require_once 'config.inc.php';
    // require_once 'functions.inc.php';

    $un = $_POST['username'];
    $pw = $_POST['password'];
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $phn = $_POST['phone'];

    $username = stripcslashes($un);
    $pw = stripcslashes($pw);
    $fn = stripcslashes($fn);
    $ln = stripcslashes($ln);

    $un = mysqli_real_escape_string($conn, $un);
    $pw = mysqli_real_escape_string($conn, $pw);

    // Encrypt the password
    $pw = md5($pw);

    $sql = "SELECT * FROM salon.users WHERE username = '$un' LIMIT 1";
    $result = $conn->query($sql);

    $user_exist = false;
    if ($result->num_rows > 0) {
        $user_exist = true;
    }

    if ($user_exist != false) {
        echo '<script>
        alert("Username is already existing");
        window.location.replace("../signup.php");
        </script>';
        exit();
    }

    $sql = "INSERT INTO salon.users (first_name, last_name, phone, username, password, date_created) VALUES ('$fn', '$ln', '$phn', '$un', '$pw', now())";

    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['fn'] = $fn;
        $_SESSION['ln'] = $ln;
        $_SESSION['un'] = $un;
        $_SESSION['phn'] = $phn;

        echo '<script>
        alert("Sign up success");
        window.location.replace("../index.php");
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Something went wrong.");
        window.location.replace("../signup.php");
        </script>';
        exit();
    }
}
exit();
