<?php
session_start();
if (!isset($_SESSION['id'])) { // Check if the user is logged in
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mx-auto m-5 div-shadow">
    <h1 class="text-center text-white mt-3">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <div class="row">
        <!-- Left side: Welcome Message -->
        <div class="col-md-6 first">
            <p class="text-white text-center">You are now logged in and can access exclusive features. Feel free to explore!</p>
            <h3 class="text-white text-center"><?php echo htmlspecialchars($_SESSION['email']); ?></h3>
        </div>

        <!-- Right side: Background Image -->
        <div class="col-md-6 second img3">
            <!-- Background image applied here via CSS -->
        </div>
    </div>

    <div class="text-center mt-4 mb-3">
        <a href="logout.php" class="btn btn-danger border-warning">Logout</a> <!-- Link to log out -->
    </div>
    <div class="text-center mt-4 mb-3">
        <a href="register.php" class="btn btn-primary border-warning">Register New Account</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
