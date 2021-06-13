<?php
    include("data.php");
    if(isset($_GET['del_id'])){
        $del_id = $_GET['del_id'];
        $ptype = $_GET['ptype'];
        echo "$ptype";
	    $delete_post = "delete from ".$ptype."  where id=$del_id";
        $run_delete= pg_query($conn,$delete_post);
	    if($run_delete){
    		echo "<script>alert('A post have been deleted!')</script>";
		    echo "<script>window.open('ownerposts.php','_self')</script>";
	    }   
    }
    pg_close();
?>