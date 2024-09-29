<?php
require_once '../src/config.php';
session_start();
$error_message = "";

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, username,password,email FROM users WHERE email = ?"; // SQL query to check if the email exists in the database

    if ($stmt = $conn->prepare($sql)){ // Prepare the SQL statement
        $stmt->bind_param("s", $email); // Bind the email entered in the form to the SQL query
        $stmt->execute();
        $stmt->store_result(); // Store the result of the query

        // Check if a user with that email exists in the database
        if ($stmt->num_rows == 1){
            $stmt->bind_result($id, $username, $hashed_password, $email);
            $stmt->fetch(); // Fetch the data from the result

            if (password_verify($password, $hashed_password)){ //Verify the entered password with the stored hashed password
                $_SESSION['id']=$id;
                $_SESSION['username']=$username;
                $_SESSION['email']=$email; //Store the user ID , username and email in the session

                header("Location: welcome.php"); // Redirect to the welcome page
                exit();
            } else{
                $error_message = "Invalid Password!";
            }
        } else{
            $error_message = "No account found with that email.";
        }
        // Close the prepared statement
        $stmt->close();
    }

}
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mx-auto m-5 div-shadow">
    <h1 class="text-center text-white mt-3">Sign In</h1>
    <div class="row">
        <!-- Left side: Form -->
        <div class="col-md-6 first">
            <form action="index.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                    <label for="floatingInput">Email Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-secondary border-warning">Login</button>
                </div>
                <!-- Display error message if set -->
                <?php if (!empty($error_message)): ?>
                    <div style="color: red;" class="text-center mt-3"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>

            </form>
        </div>

        <!-- Right side: Background Image -->
        <div class="col-md-6 second img2">
            <!-- Background image applied here via CSS -->
        </div>
    </div>

    <p class="text-center text-white">Don't have an account? <a href="register.php">Sign up here</a>.</p>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>


