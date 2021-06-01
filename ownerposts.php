<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ownerposts.css">
    <title>Document</title>
</head>

<body>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
</div>

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
            <?php
            for ($i = 0; $i < 6; $i++)
                echo '<div class="posts" id="myBtn">
            <div class="thumb">
                <img id="im" src="img\appoin.jpg" alt="">
            </div>
            <div class="det">
                <div class="le">
                    <span class="s">@BHK Flat</span>
                    <span class="s">Floor no:n</span>
                    <span class="s">locality:Nashik</span>
                </div>
                <div class="ri">
                    <span class="s">rent:</span>
                    <span class="s">Status: Available</span> <!---if(not available) disable will be available from--->
                </div>
            </div>
        </div>';
            ?>
        </div>

    </div>
    
    <div class="footer">
        <?php include("footer.php") ?>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementsByClassName("posts");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
            console.log("hello");
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>