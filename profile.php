<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendia - Login</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="navbar">
        <div class="container">
            <a class="logo" href="aboutus.html">Calend<span>ia</span></a>
            <ul class="primary-nav">
                <li><a href="calendar.html">Month view</a></li>
                <li><a href="weekview.html">Week view</a></li>
            </ul>
            <nav class="">
                
                <ul class="secondary-nav">
                    <li class="current"><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <?php
    session_start();

    $mysqli = require __DIR__ . "/database.php";
    $stmt = $mysqli->prepare('SELECT * FROM cart WHERE user_id=?');
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $total = 0;
    $result = $stmt->get_result();
    foreach ($result as $row) {
        $total = $total + $row['amount'];
    }
    ?>
    <section class="hero">
        <div class="container">
            <menu class="form">
                <label class="uname"><b>Cart Total:</b></label>
                <span class="uname-value"><?php echo $total?>$</span>
        
                <label>
                  <input type="checkbox" checked="checked" name="reminders"> Recieve event emails
                </label>
                <label>
                    <input type="checkbox" name="darkmode"> Darkmode
                </label>
                <label>
                    <input type="checkbox" name="updates"> Recieve information about Calendia updates
                </label>
    
                <a href="index.php"><button type="button" class="logout">Logout</button></a>
                <button type="button" class="delete-account">Delete Account</button>
            </menu >
        </div>
    </section>
</body>
</html>