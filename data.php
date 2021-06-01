<?php
    $host="localhost";
    $user="postgres";
    $pass="owais";
    $db="rentmgmtsys";
    $conn=pg_connect("host=$host dbname=$db user=$user password=$pass")
        or die("could not connect to the server!");
?>
