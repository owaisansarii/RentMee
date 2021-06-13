<?php
session_start(); /* Starts the session */
if ($_SESSION['Active'] == false) { /* Redirects user to login.php if not logged in */
    header("location:login.php");
    exit;
}
include("data.php");
$query = 'Select * from flat where oid=' . $_SESSION['uid'];
$qrow = 'Select * from rowhouse where oid=' . $_SESSION['uid'];
$qbun = 'Select * from bungalow where oid=' . $_SESSION['uid'];
$rrow = pg_query($conn, $qrow);
$brow = pg_query($conn, $qbun);
$result = pg_query($conn, $query);
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
    <link rel="stylesheet" href="css/ownerposts.css">
    <!-- <link rel="stylesheet" href="bootstrap\css\bootstrap.css"> -->
    <link rel="stylesheet" href=css/flat.css>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <script src="bootstrap\js\bootstrap.js"></script> -->
    <title>Document</title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Property Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="property-details">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="del" ><input type="submit" id="delete" class="btn btn-primary" name="Delete" value="Delete"></input></a>
                </div>
            </div>
        </div>
        <script>
            
        </script>
    </div>
    <header>
        <?php include("includes/navbar.php"); ?>
    </header>
    <div class="has">
        <div class="dashboard">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione consequatur eum in nemo doloremque nisi tempore perspiciatis optio illo dolorem facilis rerum magnam numquam maiores, reiciendis molestias est provident! Numquam?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo numquam eos explicabo distinctio incidunt enim laboriosam minus ex sunt officia consequatur quaerat corrupti asperiores odio fugit architecto, libero, nesciunt magni.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur cumque quos aut. Corporis dolorem quisquam fugit libero consectetur a, assumenda, itaque distinctio possimus ipsum natus corrupti? Culpa atque cupiditate odit.</p>
        </div>
        <div>
            <h2>Flat</h2>
            <?php
            $imgpath = "Upload/images/" . $_SESSION['uid'] . "/flat"."/";
            $i=0;
            while ($row = pg_fetch_assoc($result)) {
                $images = pg_array_parse($row['images']);
                echo '<div class="posts" >
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
            <h2>Rowhouse</h2>
            <?php
             $imgpath = "Upload/images/" . $_SESSION['uid'] . "/rowhouse"."/";
            while ($row = pg_fetch_assoc($rrow)) {
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
            <h2>Bungalow</h2>
            <?php
            
            while ($row = pg_fetch_assoc($brow)) {
                $imgpath = "Upload/images/" . $_SESSION['uid'] . "/bungalow"."/";
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

    <div class="footer">
        <?php include("footer.php") ?>
    </div>
    <script>
        var delid=0;
        function showFlat($n) { 
             id = document.getElementsByClassName("view"); 
            
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("property-details").innerHTML = this.responseText;
                    }
                }
                var queryString = "?id=" +id[$n].value;
                xmlhttp.open("GET", "flat.php" + queryString, true);
                xmlhttp.send(null);
                delid=id[$n].value;
        }
        function showRowhouse($n) {
            id = document.getElementsByClassName("view"); 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("property-details").innerHTML = this.responseText;
                    }
                }
                var queryString = "?id=" +id[$n].value;
                xmlhttp.open("GET", "rowhouse.php" + queryString, true);
                xmlhttp.send(null);
                delid=id[$n].value;
        }
        function showBungalow($n) {
            id = document.getElementsByClassName("view"); 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("property-details").innerHTML = this.responseText;
                    }
                }
                var queryString = "?id=" +id[$n].value;
                xmlhttp.open("GET", "bungalow.php" + queryString, true);
                xmlhttp.send(null);
                delid=id[$n].value;
        }
        function gallery(){
            setTimeout(() => {  
            let thumbnails = document.getElementsByClassName('thumbnail');
            let activeImages = document.getElementsByClassName('active');
            for (var i = 0; i < thumbnails.length; i++) {
                console.log(thumbnails[i]);
                thumbnails[i].addEventListener('mouseover', function() {
                    if (activeImages.length > 0) {
                        activeImages[0].classList.remove('active');
                    }
                    this.classList.add('active');
                    document.getElementById('featured').src = this.src;
                })
            }

            let buttonRight = document.getElementById('slideRight');
            let buttonLeft = document.getElementById('slideLeft');

            buttonLeft.addEventListener('click', function() {
                document.getElementById('slider').scrollLeft -= 50;
            })
            buttonRight.addEventListener('click', function() {
                document.getElementById('slider').scrollLeft += 50;
            })
            var link = document.getElementById("del");
            var ptype = document.getElementById("ptype").value;
            var href="delete.php?del_id="+delid;
            href+= "&ptype="+ptype;
            link.setAttribute("href",href);
        }, 1000);
        }
    </script>
</body>

</html>