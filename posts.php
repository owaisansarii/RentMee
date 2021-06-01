<?php
    //session_start();
    include("data.php");
    $query='Select * from flat where oid=14';//.$_SESSION["uid"];
    $result=pg_query($conn,$query);
    $row = pg_fetch_assoc($result);
    function pg_array_parse($literal){
    if ($literal == '') return;
    preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER);
    $values = [];
    foreach ($matches as $match) {
        $values[] = $match[3] != '' ? stripcslashes($match[3]) : (strtolower($match[2]) == 'null' ? null : $match[2]);
    }
    return $values;
    }
    $images=pg_array_parse($row['images']);
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
        font-family: Verdana, sans-serif;
        margin: 0;
    }

    * {
        margin:0;
        padding:0;
        box-sizing: border-box;
    }

    .row>.column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .img-container{
        background-color: black;
        display: flex;
        flex-direction: row;
    }
    

    .column {
        /* float: left; */
        width: 25%;
        padding: 10px;
        margin:auto;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
       
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
        width:50%;
        background-color: black;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: white;
        text-align: center;
        background-color: grey;
        border-radius: 10px;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }


    img {
        margin-bottom: -4px;
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>

<body>

    <h2 style="text-align:center">Lightbox</h2>

    <div class="row">
        <?php
            $n=sizeof($images);
            echo'<div class="column">
                    <img src="Upload/images/'.$images[0].'" style="width:50%" onclick="openModal();currentSlide'.(1).'" class="hover-shadow cursor">
                </div>';

        ?>
    </div>

    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <?php
                for($i=0;$i<$n;$i++){
                    echo'<div class="mySlides">
                            <div class="numbertext">
                                '.($i+1).'/'.($n+1).'
                            </div>
                            <img class="large-img" src="Upload/images/'.$images[$i].'" style="width:50%; margin:auto">
                        </div>';
                }
            ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div class="caption-container">
                <p id="caption"></p>
            </div>
            <div class="img-container">
            <?php
            for($i=0;$i<$n;$i++){   
            echo '<div class="column">
                <img class="demo cursor" src="Upload/images/'.$images[$i].'" style="width:100%" onclick="currentSlide('.($i+1).')" alt="Nature and sunrise">
            </div>';
            echo '<div class="column">
                <img class="demo cursor" src="Upload/images/'.$images[$i].'" style="width:100%" onclick="currentSlide('.($i+1).')" alt="Nature and sunrise">
            </div>';
            echo '<div class="column">
                <img class="demo cursor" src="Upload/images/'.$images[$i].'" style="width:100%" onclick="currentSlide('.($i+1).')" alt="Nature and sunrise">
            </div>';
            }
            
            ?>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>

</body>

</html>