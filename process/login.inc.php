<?php

if (isset($_POST['login'])) {

    require_once 'config.inc.php';
    // require_once 'functions.inc.php';

    $un = $_POST['username'];
    $pw = $_POST['password'];

    $username = stripcslashes($un);
    $pw = stripcslashes($pw);
    $un = mysqli_real_escape_string($conn, $un);
    $pw = mysqli_real_escape_string($conn, $pw);

    // Encrypt the password
    $pw = md5($pw);

    $sql = "SELECT * FROM salon.users WHERE username='$un' and password='$pw' LIMIT 1";
    $sql_result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sql_result) > 0) {
        while ($row = mysqli_fetch_assoc($sql_result)) {
            session_start();
            $_SESSION["id"] = $row['id'];
            $_SESSION['fn'] = $row['first_name'];
            $_SESSION['ln'] = $row['last_name'];
            $_SESSION['phn'] = $row['phone'];
            $_SESSION['un'] = $row['username'];
            $_SESSION['pw'] = $row['password'];
            echo '<script>
        window.location.replace("../index.php");
        </script>';
            exit();
        }
    } else {
        echo '<script>
        alert("Wrong email or password.");
        window.location.replace("../signup.php");
        </script>';
        exit();
    }
}
exit();
