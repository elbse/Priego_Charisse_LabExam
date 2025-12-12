<?php
// Start the session
session_start();

// Hardcoded credentials (for demo only)
// $valid_username = "admin";
// $valid_password = "1234";

// $message = "";

// FIXED: CHECK REQUEST METHOD CORRECTLY
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Get the submitted username & password
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     if ($username === $valid_username && $password === $valid_password) {
//         $_SESSION["user"] = $username;
//         header("Location: dashboard.php");
//         exit();
//     } else {
//         $message = "Invalid username or password!";
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container" >
    <div class="login-box">
        <h2>Welcome</h2>

        <?php if (!empty($message)) : ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <h3>Email</h3>
            <input type="text" name="username" required>
            <h3>Password</h3>
            <input type="password" name="password"required>
            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
