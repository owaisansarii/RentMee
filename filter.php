<?php
    session_start(); 
    if ($_SESSION['Active'] == false) { /* Redirects user to login.php if not logged in */
        header("location:login.php");
        exit;
    }
    include("data.php");
    if(isset($_POST['Apply'])){
        if($_POST['ptype']==="flat"){
            $query = 'Select * from flat';
            $qrow = 'Select * from rowhouse where id=232323';
            $qbun = 'Select * from bungalow where id=232323';
            $result = pg_query($conn, $query);
            $rrow = pg_query($conn, $qrow);
            $brow = pg_query($conn, $qbun);
        }
        else if($_POST['ptype']==="rowhouse"){
            $query = 'Select * from flat where id=23233';
            $qrow = 'Select * from rowhouse';
            $qbun = 'Select * from bungalow where id=232323';
            $rrow = pg_query($conn, $qrow);
            $result = pg_query($conn, $query);
            $brow = pg_query($conn, $qbun);
           
        }
        else if($_POST['ptype']==="bungalow"){
            $query = 'Select * from flat where id=23233';
            $qrow = 'Select * from rowhouse where id=232323';
            $qbun = 'Select * from bungalow';
            $rrow = pg_query($conn, $qrow);
            $result = pg_query($conn, $query);
            $brow = pg_query($conn, $qbun);
        }
        else{
            $query = 'Select * from flat';
            $qrow = 'Select * from rowhouse';
            $qbun = 'Select * from bungalow';
            $rrow = pg_query($conn, $qrow);
            $brow = pg_query($conn, $qbun);
            $result = pg_query($conn, $query);
        }
        

    }
    function pg_array_parse($literal)
    {
        if ($literal == '') return;
        preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER);
        $values = [];
        foreach ($matches as $match) {
            $values[] = $match[3] != '' ? stripcslashes($match[3]) : (strtolower($match[2]) == 'null' ? null : $match[2]);
        }
        return $values;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href=css/flat.css>
    <title>Document</title>
</head>
<body>
    <head>
        <?php include("includes/navbar.php");?>
    </head>
    <div class="has">
        <div class="dashboard">
        <form action="filter.php" method="post">
        <div style="border: 2px solid black; border-radius:10px">
        <input type="radio" name="ptype" value="flat"></input>
        <label for="ptype">Flat</label><br>
        <input type="radio" name="ptype" value="rowhoues"></input>
        <label for="ptype">Rowhouse</label><br>
        <input type="radio" name="ptype" value="bungalow"></input>
        <label for="ptype">Bungalow</label><br>
        </div> 
        <br>
        
        <select id="city" class="butn" aria-label="Default select example" >
        
        </select>
        <br>
        <div style="border: 2px solid black; border-radius:10px">
        <input type="radio" name="rent" value="0 AND 3000">0-3000</input><br>
            <input type="radio" name="rent" value="3000 AND 5000">3000-5000</input><br>
            <input type="radio" name="rent" value="5000 AND 10000">5000-10000</input><br>
            <input type="radio" name="rent" value="10000 AND 20000">10000-20000</input><br>
            <input type="radio" name="rent" value="20000 AND 30000">20000-30000</input><br>
            <input type="radio" name="rent" value="30000 AND 50000">30000-50000</input><br>
        </div>
        <br>
        <?php

        ?>
        <input type="submit" name="Apply" style="width: 100px; height:20px ;border-radius:10px; margin:auto">
        </form>
        </div>
        <div>
        <div id="fl">
        <h2>Flat</h2>
            <?php
            $i=0;
            while ($row = pg_fetch_assoc($result)) {
                $imgpath = "Upload/images/".$row['oid']."/flat"."/";
                $images = pg_array_parse($row['images']);
                echo '<div class="posts">
                        <div class="heading">
                            <b >' . $row["bhk"] . ' BHK Flat For Rent In ' . $row["locality"] .'</b>
                            <div class="more">'.$row["more"].'</div>
                            <p>To read more tap on view</p>
                        </div>
                        <div class="all">
                            <div class="thumb">
                                <img id="im" src="' . $imgpath . $images[0] . '" alt="">
                            </div>
                            <div class="det">
                                <div class="le">
                                    <span class="s">' . $row["bhk"] . 'BHK Flat</span>
                                    <span class="s">Floor no:' . $row["floor"] . '</span>
                                    <span class="s">locality:' . $row["locality"] .'</span>
                                </div>
                                <div class="ri">
                                    <span class="s">Rent:' . $row["rent"] . 'Rs</span>
                                    <span class="s">Status: Available</span> <!---if(not available) disable will be available from--->
                                    <input type="hidden" class="view" value="'.$row["id"].'">
                                    <input style="background-color: transparent; color: grey; border: 1px solid grey; border-radius:10px" type="button" onclick="showFlat('.$i.'); gallery();" name="view" value="view"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-xs view_data" />  
                                </div>
                            </div>
                            </div>
                        </div>';
                        $i++;
                }
            ?>
            </div>
            <div id="rh">
            <h2>Rowhouse</h2>
            <?php
            
            while ($row = pg_fetch_assoc($rrow)) {
                $imgpath = "Upload/images/".$row['oid']."/rowhouse"."/";
                $type="";
                $image = pg_array_parse($row['images']);
                if($row['no_of_floor']==1){
                    $type="Normal";
                }
                else if($row['no_of_floor']==2){
                    $type="Duplex";
                }
                else if($row['no_of_floor']==3){
                    $type="Triplex";
                }
                else if($row['no_of_floor']==4){
                    $type="Quadplex";
                }
                echo '<div class="posts" >
                <div class="heading">
                    <b >' . $type. ' RowHouse For Rent In ' . $row["locality"] .'</b>
                    <div class="more">'.$row["more"].'</div>
                    <p>To read more tap on view</p>
                </div>
                <div class="all">
                    <div class="thumb">
                                <img id="im" src="' . $imgpath . $image[0] . '" alt="">
                            </div>
                            <div class="det">
                                <div class="le">
                                    <span class="s">No of Rooms: ' . $row["no_of_room"] . '</span>
                                    <span class="s">Floor no: ' . $row["area"] . '</span>
                                    <span class="s">locality: ' . $row["locality"] . '</span>
                                </div>
                                <div class="ri">
                                    <span class="s">Rent: ' . $row["rent"] . 'Rs</span>
                                    <span class="s">Status: Available</span> <!---if(not available) disable will be available from--->
                                    <input type="hidden" class="view" value="'.$row["id"].'">
                                    <input type="hidden" class="ptype" value="rhouse">
                                    <input style="background-color: transparent; color: grey; border: 1px solid grey; border-radius:10px" type="button" onclick="showRowhouse('.$i.'); gallery();" name="view" value="view"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-xs view_data" />  
                                </div>
                            </div>
                            </div>
                        </div>';
                        $i++;
            }
            ?>
            </div>
            <div id="bg">
            <h2>Bungalow</h2>
            <?php
            while ($row = pg_fetch_assoc($brow)) {
                $imgpath = "Upload/images/".$row['oid']."/bungalow"."/";
                $image = pg_array_parse($row['images']);
                echo '<div class="posts" >
                <div class="heading">
                    <b >Bungalow For Rent In ' . $row["locality"] .'</b>
                    <div class="more">'.$row["more"].'</div>
                    <p>To read more tap on view</p>
                </div>
                <div class="all">
                    <div class="thumb">
                                <img id="im" src="' . $imgpath . $image[0] . '" alt="">
                            </div>
                            <div class="det">
                                <div class="le">
                                    <span class="s">No of Rooms: ' . $row["no_of_room"] . '</span>
                                    <span class="s">Floor no: ' . $row["area"] . '</span>
                                    <span class="s">locality: ' . $row["locality"] . '</span>
                                </div>
                                <div class="ri">
                                    <span class="s">Rent: ' . $row["rent"] . 'Rs</span>
                                    <span class="s">Status: Available</span> <!---if(not available) disable will be available from--->
                                    <input type="hidden" class="view" value="'.$row["id"].'">
                                    <input type="hidden" class="ptype" value="bungalow">
                                    <input style="background-color: transparent; color: grey; border: 1px solid grey; border-radius:10px" type="button" onclick="showBungalow('.$i.'); gallery();" name="view" value="view"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-xs view_data" />  
                                </div>
                            </div>
                            </div>
                        </div>';
                        $i++;
            }
            ?>
            </div>
        </div>
    </div>
    <footer>
        <?php include("footer.php"); ?>
    </footer>

    <script>
        document.getElementById("city").style.display="none";
        $('input[type=radio][name=ptype]').change(function() {
            document.getElementById("city").style.display="block";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('city').innerHTML = this.responseText;
                }
            };
            var x = this.value;
            xhttp.open("GET", ("change_city.php?ptype=" + x ), true);
            xhttp.send();
        });

    </script>
</body>
</html>