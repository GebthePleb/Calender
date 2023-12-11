<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendia - Login</title>
    <link rel="stylesheet" href="css/upgrade.css">
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
                    <li class="current"><a href="upgrade.php">Upgrade</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <section class="hero">
        <div class="container">
            <form action="cart.php" method="post">
                <p id="header"> Donate </p>
                <label for="amount"><b>Amount:</b></label>
                <input type="number" placeholder="Donation amount" name="amount" id ="amount" required>
                <input type="submit" name="add_to_cart" value="Add to cart">
            </form>
        </div>
    </section>
</body>
</html>