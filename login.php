<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- stylesheet for index -->
    <!-- dont remove the php line -->
    <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- this is where you put your wallpaper or something -->
    <section id="loginSection">
        <!-- The code below is the wrapper -->
        <!-- It auto align the padding and margin -->
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 d-flex justify-content-center align-items-center flex-column text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <img class="img-fluid" style="width: 6rem" src="https://png.pngtree.com/template/20191108/ourmid/pngtree-beauty-spa-logo-design-template-woman-silhouette-logo-template-image_328588.jpg" alt="Logo photo">
                        <h3 id="companyName">Company Name</h3>
                    </div>
                    <h4>Login</h4>
                    <form action="process/login.inc.php" method="post">
                        <div class="input">
                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" required>
                        </div>
                        <div class="input">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" required>
                        </div>
                        <input id="login" name="login" type="Submit" value="Login">
                    </form>
                    <hr class="divider">
                    <p>Don't have an account? Sign up <a href="signup.php">here</a></p>
                </div>
            </div>
        </div>
    </section>



    <!-- script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>