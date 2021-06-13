<?php
    include("data.php");
    if($_GET['ptype']==="flat"){
        $q = "select distinct(city) from flat";
        $r = pg_query($conn, $q);
        $ro = pg_fetch_assoc($r);
        $output="<option selected value=" . $ro['city'] . ">".$ro['city']."</option>";
        while ($ro = pg_fetch_assoc($r)) {
            $output.="<option value=" . $ro['city'] . ">" . $ro['city'] . "</option>";
        }
        echo $output;
    }
    else if($_GET['ptype']==="rowhouse"){
        $q = "select distinct(city) from rowhouse";
        $r = pg_query($conn, $q);
        $ro = pg_fetch_assoc($r);
        $output="<option selected value=" . $ro['city'] . ">".$ro['city']."</option>";
        while ($ro = pg_fetch_assoc($r)) {
            $output.="<option value=" . $ro['city'] . ">" . $ro['city'] . "</option>";
        }
        echo $output;
    }
    else if($_GET['ptype']==="bungalow"){
        $q = "select distinct(city) from bungalow";
        $r = pg_query($conn, $q);
        $ro = pg_fetch_assoc($r);
        $output="<option selected value=" . $ro['city'] . ">".$ro['city']."</option>";
        while ($ro = pg_fetch_assoc($r)) {
            $output.="<option value=" . $ro['city'] . ">" . $ro['city'] . "</option>";
        }
        echo $output;
    }
    else {
        echo "<script>alert(No city has ".$_GET['ptype'].")</script>";
        echo "<option value='not found'>Not found</option>";
    }
?>