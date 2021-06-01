
<?php
    session_start(); /* Starts the session */
    if ($_SESSION['Active'] == false) { /* Redirects user to login.php if not logged in */
      header("location:login.php");
      exit;
    }
    include("data.php");
    $query='Select * from flat where oid=.$_SESSION["uid"]';
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="bootstrap\css\bootstrap.css"> -->
    <link rel="stylesheet" href="text.css">
    <title>Document</title>
</head>

<body>
    <div class="con">
        <div class="feature">
            <?php
                $imgpath="Upload/images/".$_SESSION['uid']."/";
                echo '<img id="featured" src="'.$imgpath.$images[0].'">';
            ?>
        </div>
        <div id="slide-wrapper">
            <img id="slideLeft" class="arrow" src="img/arrow-circle-left.svg">
            <div id="slider">
                <img class="thumbnail active" src="<?php echo "$imgpath.$images[0]" ?>">
                <?php
                    for($i=1;$i<$n;$i++)
                        echo '<img class="thumbnail" src="'.$imgpath.$images[$i].'">';
                ?>
            </div>
            <img id="slideRight" class="arrow" src="img/arrow-circle-right.svg">
        </div>
    </div>


    <script>
        let thumbnails = document.getElementsByClassName('thumbnail');
        let activeImages = document.getElementsByClassName('active');

        for (var i = 0; i < thumbnails.length; i++) {
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
    </script>
</body>

</html>