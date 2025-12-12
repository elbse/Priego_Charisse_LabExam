<?php

session_start();


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$showSuccessPopup = false;
$showErrorPopup = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    
    $userFound = false;
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $userFound = true;
            $_SESSION["logged_in_user"] = $user;
            $_SESSION["show_login_success"] = true;
            // Redirect to prevent popup on reload
            header("Location: login.php");
            exit();
        }
    }

    if (!$userFound) {
        $_SESSION["show_login_error"] = "Invalid email or password!";
        // Redirect to prevent popup on reload
        header("Location: login.php");
        exit();
    }
}

// Check if we should show success popup (only once)
if (isset($_SESSION["show_login_success"]) && $_SESSION["show_login_success"] === true) {
    $showSuccessPopup = true;
    // Clear the flag so it doesn't show again on reload
    unset($_SESSION["show_login_success"]);
}

// Check if we should show error popup (only once)
if (isset($_SESSION["show_login_error"])) {
    $showErrorPopup = true;
    $errorMessage = $_SESSION["show_login_error"];
    // Clear the flag so it doesn't show again on reload
    unset($_SESSION["show_login_error"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body></body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container" >
    <div class="login-box">
        <h2>Welcome!</h2>

        <form method="POST" id="loginForm">
            <h5>Email</h5>
            <input type="text" name="username" required>
            <h5>Password</h5>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <div class="line">
            <a href="#" class="forgot">Forgot Password?</a>
        </div>

       
       <div class="footer-links">
            <p class="signup">
                Don’t have an account? <a href="register.php" class="signup-link">Sign Up</a>
            </p>
            <a href="#" class="terms">Terms & Conditions</a>
        </div>



    </div>
</div>

<div class="image">
    <img src="assets/Group12.png" alt="Image">
</div>


<?php if ($showSuccessPopup): ?>
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup('successPopup')">&times;</span>
        <p>Signed In</p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('successPopup').style.display = 'flex';
        setTimeout(function() {
            closePopup('successPopup');
        }, 3000);
    });
</script>
<?php endif; ?>

<?php if ($showErrorPopup): ?>
<div id="errorPopup" class="popup">
    <div class="popup-content popup-error">
        <span class="popup-close" onclick="closePopup('errorPopup')">&times;</span>
        <p><?php echo htmlspecialchars($errorMessage); ?></p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('errorPopup').style.display = 'flex';
        setTimeout(function() {
            closePopup('errorPopup');
        }, 3000);
    });
</script>
<?php endif; ?>

<script>
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}
</script>

</body>
</html>
