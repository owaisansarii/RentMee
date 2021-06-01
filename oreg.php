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
    <link rel="stylesheet" href="css/oreg.css">
    <title>Document</title>
</head>

<body>
    <?php
    $msg = " ";
    if (isset($_POST['Submit'])) {
        include("data.php");
        $id = $_SESSION['uid'];
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $city = $_POST['city'];
        $phno = $_POST['phno'];
        $query = "INSERT INTO owner values('$id','$uid','$name','$city','$phno')";
        $rs = pg_query($conn, $query);
        if ($rs) {
            mkdir("Upload/img/$id");
            echo "<script>alert(Registration Successfull)</script>";
            header("location:post.php");
        } else {
            $msg = "Something Went Wrong";
        }
    }
    ?>
    <div class="header">
        <?php include("includes/navbar.php"); ?>
    </div>
    <div class="cont">
        <div class="why">
            <span class="li">
                <h5>Why Post through US</h5>
            </span>
            <span class="li">Zero Brokerage</span>
            <span class="li">Get Tenants Faster</span>
            <span class="li">Trusted</span>
        </div>
        <div class="odet">
            <form class="owner" action="" method="post">
                <label for="uid">Adhar-Card no</label>
                <input type="number" name="uid">
                <label for="name">Name</label>
                <input type="text" name="name">
                <label for="phno">Mobile no</label>
                <input type="number" name="phno" min="5555555555" max="9999999999">
                <label for="city">City</label>
                <input type="text" name="city">
                <?php
                echo "<p style='color:red;'>$msg</p>";
                ?>
                <input class="bt" type="submit" value="Submit" name="Submit">
            </form>
        </div>
    </div>
    <div class="det">
        <div class="one">
            <div class="text">
                <h5 class="de">Simple Listing Process</h5>
                <p>As an owner you can list your property in a few minutes. Just fill out our super simple form. Your property will go live after verification.</p>
            </div>
            <div class="img">
                <img src="img/list.jpg" alt="">
            </div>
        </div>
        <div class="one">
            <div class="img">
                <img src="img/appoin.jpg" alt="">
            </div>
            <div class="text">
                <h5 class="de">Tenant Selects Property and Schedules an Appointment</h5>
                <p>If a tenant likes your property they will request for your contact details. Both parties will receive contact information and then arrange for a visit.</p>
            </div>

        </div>
        <div class="one">
            <div class="text">
                <h5 class="de">Deal Closure</h5>
                <p>Owner and tenant can meet or do agreement on out site to close the deal directly. RentMe can help create a rental agreement and deliver it to your doorstep.
            </div>
            <div class="img">
                <img src="img/deal.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include("footer.php"); ?>
    </div>
</body>

</html>