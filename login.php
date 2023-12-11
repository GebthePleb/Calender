<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["uname"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["psw"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: aboutus.html");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendia - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="navbar">
        <div class="container">
            <a class="logo" href="index.php">Calend<span>ia</span></a>
            <nav class="">
                <ul class="secondary-nav">
                    <li class="signup-cta"><a href="signup.html">Sign-Up</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        function validateLogin() {
            let pass = document.querySelector("#psw").value;
            if(pass.length() < 8 ){
                alert("Password too short");
                document.getElementById("psw").style.borderColor = "red";
                return false;
            }
            else {
                return true;
            }
        }
    </script>

    <section class="hero">
        <div class="container">
            <?php if ($is_invalid): ?>
                <em>Invalid login</em>
            <?php endif; ?>
            <div class="form">
                <form method="post" onsubmit="return validateLogin();">
                    <label for="uname"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="uname" required>
            
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required id="psw">
                    
                    <button type="submit">Login</button>
                    <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </form>
            </div>

            <div class="extra" style="background-color:#f1f1f1">
                <span class="psw">Forgot <a href="forgot.html">password?</a></span>
              </div>
        </div>
    </section>
</body>
</html>