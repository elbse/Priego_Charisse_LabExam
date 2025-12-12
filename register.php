<?php

session_start();


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$showSuccessPopup = false;
$showErrorPopup = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";


    $emailExists = false;
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            $emailExists = true;
            $_SESSION["show_register_error"] = "Email already registered!";
            // Redirect to prevent popup on reload
            header("Location: register.php");
            exit();
        }
    }

    
    if (!$emailExists && !empty($fullname) && !empty($email) && !empty($username) && !empty($password)) {
        $newUser = array(
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $password
        );
        $_SESSION['users'][] = $newUser;
        $_SESSION["show_register_success"] = true;
        // Redirect to prevent popup on reload
        header("Location: register.php");
        exit();
    }
}

// Check if we should show success popup (only once)
if (isset($_SESSION["show_register_success"]) && $_SESSION["show_register_success"] === true) {
    $showSuccessPopup = true;
    // Clear the flag so it doesn't show again on reload
    unset($_SESSION["show_register_success"]);
}

// Check if we should show error popup (only once)
if (isset($_SESSION["show_register_error"])) {
    $showErrorPopup = true;
    $errorMessage = $_SESSION["show_register_error"];
    // Clear the flag so it doesn't show again on reload
    unset($_SESSION["show_register_error"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container">
    <div class="login-box">
        <h2>Create Account</h2>

        <form method="POST" id="registerForm">
            <h5>Full Name</h5>
            <input type="text" name="fullname" required>

            <h5>Email</h5>
            <input type="email" name="email" required>

            <h5>Username</h5>
            <input type="text" name="username" required>

            <h5>Password</h5>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

       
        <div class="footer-links">
            <p class="signup">
                Already have an account? <a href="login.php" class="signup-link">Login</a>
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
        <p>Account Created</p>
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
