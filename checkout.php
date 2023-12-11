<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendia - Login</title>
    <link rel="stylesheet" href="css/checkout.css">
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
                    <li><a href="upgrade.php">Upgrade</a></li>
                    <li><a href="profile.php">Profile</a></li>
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
        <script>
        function validateForm() {
            let card = document.querySelector("#card").value;
            let address = document.querySelector("#address").value;
            if(card ==""){
                alert("Please add a card");
                document.getElementById("card").style.borderColor = "red";
                return false;
            }
            else if(isNaN(card)){
                alert("Please enter a valid card number");
                document.getElementById("card").style.borderColor = "red";
                return false;
            }
            else if(address== "" ){
                alert("Please add an address");
                document.getElementById("address").style.borderColor = "red";
                return false;
            }
            else {
                return true;
            }
        }
        </script> 
    <section class="hero">
        <div class="container">
            <form action="donate.php" method="post" onsubmit="return validateForm();">
                <p id="header"> Checkout </p>
                <label for="card"><b>Card #:</b></label>
                <input type="text" placeholder="Card Number" name="card" id ="card" required>
                <label for="address"><b>Address:</b></label>
                <input type="text" placeholder="Address" name="address" id ="address" required>
                <p name = 'amount', id = 'amount'><b>Donation: <?php echo $total?>$</b></p>
                <p name = 'tax', id = 'tax'><b>Tax: <?php $tax = $total * 0.04225; echo $tax?>$</b></p>
                <p><b>Total: <?php $final = $tax + $total; echo $final?>$</b></p>
                <input type="submit" name="checkout" value="Checkout">
            </form>
            <form action = "clearcart.php"method="post">
                <input type="submit" name="EmptyCart" value="Empty Cart">
            </form>
        </div>
    </section>
</body>
</html>