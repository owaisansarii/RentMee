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
    <link rel="stylesheet" href="css/post.css">
    <title>Document</title>
</head>

<body>

    <div class="header">
        <?php include("includes/navbar.php"); ?>
    </div>
    <div class="m">
        <div class="contain">
            <div class="colu">
                <?php include("Upload/pdetails.php"); ?>
            </div>
            <div class="colu">
                <h3> Why Post through us?</h3>

                <p>Zero Brokerage</p>

                <p>Faster Tenants</p>

                <p>10 lac tenants/buyers connections</p>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include("footer.php"); ?>
    </div>
</body>

</html>