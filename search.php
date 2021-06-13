<?php
    include("data.php");
    if(isset($_POST['Search'])){
        $city=$_POST['city'];
        $ptype=$_POST['ptype'];
        if(empty($locality) && empty($rent)){
            $query = "Select * from $ptype where city='$city'";
        }
        else if(empty($locality)){
            $query = "Select * from $ptype where city='$city' and rent between $rent";
        }
        else if(empty($rent)){
            $query = "Select * from $ptype where city='$city' and locality='$locality'";
        }
        else{
            $rent=$_POST['rent'];
            $locality=$_POST['search'];
            $query = "Select * from $ptype where city='$city' and locality='$locality' and rent between $rent";
        }
        $result = pg_query($conn, $query);
    }else{
        $query = "Select * from flat";
        $result = pg_query($conn, $query);
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
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem cupiditate, assumenda maiores error natus repellat, aperiam inventore in, sint accusamus ipsum quibusdam explicabo dolores? Voluptatem deserunt inventore harum quis nemo.</p>
            <!-- <select id="locality"> </select> -->
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur cumque quos aut. Corporis dolorem quisquam fugit libero consectetur a, assumenda, itaque distinctio possimus ipsum natus corrupti? Culpa atque cupiditate odit.</p>
        </div>
        <div>
            <h2>Search</h2>
            <?php
            $i=0;
            
            while ($row = pg_fetch_assoc($result)) {
                if(empty($ptype))
                    $ptype="flat";
                $imgpath = 'Upload/images/'.$row["oid"].'/'.$ptype.'/';
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
            
        </div>
    </div>
    <footer>
        <?php include("footer.php"); ?>
    </footer>

    <script>
        document.getElementById("city").style.display="none";
         $('#Property').change(function() {
            document.getElementById("city").style.display="block";
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('city').innerHTML = this.responseText;
                }
            };
            var x = document.getElementById("Property").value;
            xhttp.open("GET", ("change_city.php?ptype=" + x ), true);
            xhttp.send();
        });

       
    </script>
</body>
</html>