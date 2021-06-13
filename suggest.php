<?php
    include("data.php");
    $query = "Select distinct(locality) from ".$_GET["ptype"]." where city= '".$_GET["city"]."'" ;
    $count1=0; // for 5 values
    $res=pg_query($conn,$query);
    echo "<datalist id=\"listit\">";
    while($i= pg_fetch_row($res)){
            $count1++;
            echo "<option value='".$i[0]."' >";
            if($count1==5){
                break;
            }
        }
    echo "</datalist>";
?>