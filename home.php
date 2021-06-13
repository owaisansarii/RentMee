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
    <title>Document</title>
    <!-- <link rel="stylesheet" href="bootstrap/cs/bootstrap.css"> -->
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <div class="header">
        <?php include("includes/navbar.php"); ?>
    </div>
    <div class="search">
        <p class="head">Search from multiple localities</p>
        <div class="search-line">
            <select id="city" class="butn" aria-label="Default select example">
                <?php
                include("data.php");
                $query = "select city from flat UNION select city from bungalow UNION select city from rowhouse order by city";
                $result = pg_query($conn, $query);
                $row = pg_fetch_assoc($result);
                echo "<option selected value=" . $row['city'] . ">" . $row['city'] . "</option>";
                while ($row = pg_fetch_assoc($result)) {
                    echo "<option value=" . $row['city'] . ">" . $row['city'] . "</option>";
                }
                ?>
            </select>
            <form action="search.php" method="post">
                <input type="hidden" id="c" name="city" value="">
                <input id="s" type="text" class="search-ip" list="listit" name="search" onkeyup="suggest(this.value)" placeholder="Enter a locality">
                <div id="suggest_container" style="display:inline-block;">
                    <datalist id="listit">
                        <option></option>
                    </datalist>
                </div>
        </div>
        <select class="bn" name="rent" id="rent" aria-label="Default select example">
            <option selected disabled>Rent Range(Per Month)</option>
            <option value="0 AND 3000">0-3000</option>
            <option value="3000 AND 5000">3000-5000</option>
            <option value="5000 AND 10000">5000-10000</option>
            <option value="10000 AND 20000">10000-20000</option>
            <option value="20000 AND 30000">20000-30000</option>
            <option value="30000 AND 50000">30000-50000</option>
        </select>
        <div style="padding: 15px;">
            Flat<span id="f" class="fr"></span>
            Rowhouse<span id="r" class="rr"></span>
            Bungalow<span id="b" class="br"></span>
            <input type="hidden" name="ptype" id="rad"></input>
        </div>
        <input type="submit" class="butn" name="Search" value="Search">
        </form>

    </div>
    <div class="owner">
        <p style="color:#8860d0; font-size:medium"> For Property Owner<br> Post free ad </p>
        <div class="for-sale">
            <div class="faded">
                <p class="a">Fast and verified Tenant/Buyers</p>
                <p class="a">Spend ZERO on brokerage</p>
                <button class="ad" onclick="window.location.href='verifyowner.php'">Post ad</button>
            </div>
            <img class="for-sale" src="img/for_sale1.svg" alt="">
        </div>
    </div>
    <div class="why">
        <div class="left"></div>
        <div class="middle">
            <h3>Why Use RentME</h3>
        </div>
        <div class="right"></div>
    </div>
    <div class="gallery">
        <div class="upper">
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>Avoid Brokers</i>
            </div>
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>Post your ad for free</i>
            </div>
        </div>
        <div class="lower">
            <div class="image">
                <img src="img/undraw_Agreement_re_d4dv.svg" alt="" class="g">
                <i>Pay online</i>
            </div>
            <div class="image">
                <img src="img/log1.svg" alt="" class="g">
                <i>100% trusted</i>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php include("footer.php"); ?>
    </div>
    <script>
    document.getElementById("c").value="Mumbai";
        $('#city').change(function() {
            // console.log("helloa");
                var city=document.getElementById("city").value;
                document.getElementById("c").value=city;
        });
        document.getElementById("f").style.backgroundColor = "#8860d0";
        document.getElementById("rad").value = "flat";
        $("#f").click(function() {
            document.getElementById("f").style.backgroundColor = "#8860d0";
            document.getElementById("r").style.backgroundColor = "";
            document.getElementById("b").style.backgroundColor = "";
            document.getElementById("rad").value = "flat";
        })
        $("#r").click(function() {
            document.getElementById("f").style.backgroundColor = "";
            document.getElementById("r").style.backgroundColor = "#8860d0";
            document.getElementById("b").style.backgroundColor = "";
            document.getElementById("rad").value = "rowhouse";

        })
        $("#b").click(function() {
            document.getElementById("f").style.backgroundColor = "";
            document.getElementById("r").style.backgroundColor = "";
            document.getElementById("b").style.backgroundColor = "#8860d0";
            document.getElementById("rad").value = "bungalow";
        })

        function suggest(val) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('suggest_container').innerHTML = this.responseText;
                }
            };
            var x = document.getElementById("city").selectedIndex;
            city = document.getElementsByTagName("option")[x].value;
            ptype = document.getElementById("rad").value;
            xhttp.open("GET", ("suggest.php?value1=" + val + "&city=" + city + "&ptype=" + ptype), true);
            xhttp.send();
        }
    </script>
</body>

</html>