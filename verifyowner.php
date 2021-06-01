<?php
    session_start();
    if ($_SESSION['Active'] == false) { /* Redirects user to login.php if not logged in */
        header("location:login.php");
        exit;
    }
    include("data.php");

    $found=false;
    $q2 = "SELECT id FROM owner where id=".$_SESSION['uid'];
    $result = pg_query($conn, $q2);
    $row = pg_fetch_row($result);
    if($row[0]){
        header("location:post.php");
    }
    else{
        header("location:oreg.php");
    }
?>