<?php
session_start(); /* Starts the session */
if ($_SESSION['Active'] == false) { /* Redirects user to login.php if not logged in */
  header("location:login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/cs/bootstrap.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="header">
        <?php include("includes/navbar.php"); ?>
    </div>
    <div class="search">
        <p class="head">Search from multiple localities</p>
        <div class="search-line">
            <select class="butn" aria-label="Default select example">
                <option selected value="1">Mumbai</option>
                <option value="2">Banglore</option>
                <option value="3">Pune</option>
                <option value="4">Chennai</option>
                <option value="5">Gurgaon</option>
                <option value="6">Nashik</option>
                <option value="7">Hyderabad</option>
                <option value="8">Delhi</option>
                <option value="9">Noida</option>
                <option value="10">Ghaziabad</option>
            </select>
            <form action="" method="post">
                <input type="text" class="search-ip" name="search" placeholder="Enter a locality">
        </div>
        <select class="bn" aria-label="Default select example">
                <option selected disabled>Rent Range(Per Month)</option>
                <option value="2">0-3000</option>
                <option value="3">3000-5000</option>
                <option value="4">5000-10000</option>
                <option value="5">10000-20000</option>
                <option value="6">20000-30000</option>
                <option value="7">30000-50000</option>
            </select>
        <input type="button" class="butn" value="Search">
        </form>

    </div>
    <div class="owner">
        <p style="color:#8860d0; font-size:medium"> For Property Owner Post free ad </p>
        <div class="for-sale">
            <div class="faded">
                <p class="a">Fast and verified Tenant/Buyers</p>
                <p class="a">Spend ZERO on brokerage</p>
                <button class="ad" onclick="window.location.href='verifyowner.php'">Post ad</button>
            </div>
            <img class="for-sale" src="img/for_sale1.svg" alt="">
        </div>
    </div>
    <div class="why">
        <div class="left"></div>
        <div class="middle">
            <h3>Why Use RentME</h3>
        </div>
        <div class="right"></div>
    </div>
    <div class="gallery">
        <div class="upper">
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>Avoid Brokers</i>
            </div>
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>Post your ad free</i>
            </div>
        </div>
        <div class="lower">
            <div class="image">
                    <img src="img/undraw_Agreement_re_d4dv.svg" alt="" class="g">
                   <i>Pay online</i>
            </div>
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>100% trusted</i>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include("footer.php"); ?>
    </div>
</body>

</html>