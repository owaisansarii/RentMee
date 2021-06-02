<?php
if (isset($_POST['Submit'])) {
    $host = "localhost";
    $user = "postgres";
    $pass = "owais";
    $db = "rentmgmtsys";
    $conn = pg_connect("host=$host dbname=$db user=$user password=$pass")
        or die("could not connect to the server!");
    $targetDir = "Upload/images/".$_SESSION['uid']."/";
    $allowTypes = array('jpg', 'png', 'jpeg');
    $fileNames = array_filter($_FILES['files']['name']);
    $statusMsg = $errorMsg = $errorUpload = $errorUploadType = '';
    $insertValuesSQL = "{";
    if (!empty($_POST['type'])) {
        $selected = $_POST['type'];
        if ($selected === 'flat') {
            $bhk = $_POST['bhk'];
            $floor = $_POST['floor'];
            $locality = $_POST['locality'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $rent = $_POST['rent'];
            $deposit = $_POST['deposit'];
            $more = $_POST['more'];
            $balcony = $_POST['balcony'];
            $parking = $_POST['parking'];
            $negotiable = $_POST['negotiable'];
            if (!empty($fileNames)) {
                foreach ($_FILES['files']['name'] as $key => $val) {
                    // File upload path 
                    $fileName = rand(10, 10000).basename($_FILES['files']['name'][$key]) ;
                    $targetFilePath = $targetDir . $fileName;
                    echo $targetFilePath."<br>";
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to server 
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                            // Image db insert sql 
                            $insertValuesSQL .= '"'. $fileName . '", ';
                        } else {
                            $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                        }
                    } else {
                        $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                    }
                }
                $insertValuesSQL .= "}";

                $insertValuesSQL = str_replace(", }","}",$insertValuesSQL);
                echo $insertValuesSQL;
                if (!empty($insertValuesSQL)) {
                    // Insert image file name into database
                    $query = "INSERT into flat (oid,bhk,floor,locality,address,city,rent,deposit,more,balcony,parking,negotiable,images)
                         VALUES ('".$_SESSION["uid"]."','$bhk','$floor','$locality','$address','$city','$rent','$deposit','$more','$balcony','$parking','$negotiable','$insertValuesSQL')";
                    $result = pg_query($conn, $query);
                    if ($result) {
                       header("location:ownerposts.php");
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file." . $errorUpload;
                    }
                }
            } else {
                $statusMsg = 'Please select a file to upload.';
            }
            if(!empty('$statusMsg')){
                echo "<script>alert('$statusMsg');</script>";
            }
        }
        if ($selected === 'rowhouse') {
            $nor = $_POST['no_of_room'];
            $nob = $_POST['no_of_bathroom'];
            $nof = $_POST['no_of_floor'];
            $area = $_POST['area'];
            $locality = $_POST['locality'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $rent = $_POST['rent'];
            $deposit = $_POST['deposit'];
            $more = $_POST['more'];
            $balcony = $_POST['balcony'];
            $parking = $_POST['parking'];
            $negotiable = $_POST['negotiable'];
            if (!empty($fileNames)) {
                foreach ($_FILES['files']['name'] as $key => $val) {
                    // File upload path 
                    $fileName = rand(10, 10000).basename($_FILES['files']['name'][$key]) ;
                    $targetFilePath = $targetDir . $fileName;
                    echo $targetFilePath."<br>";
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to server 
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                            // Image db insert sql 
                            $insertValuesSQL .= '"'. $fileName . '", ';
                        } else {
                            $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                        }
                    } else {
                        $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                    }
                }
                $insertValuesSQL .= "}";

                $insertValuesSQL = str_replace(", }","}",$insertValuesSQL);
                echo $insertValuesSQL;
                if (!empty($insertValuesSQL)) {
                    // Insert image file name into database
                    $query = "INSERT into rowhouse (oid,no_of_room,no_of_bathroom,no_of_floor,area,locality,address,city,rent,deposit,more,balcony,parking,negotiable,images)
                         VALUES ('".$_SESSION["uid"]."','$nor','$nob','$nof','$area','$locality','$address','$city','$rent','$deposit','$more','$balcony','$parking','$negotiable','$insertValuesSQL')";
                    $result = pg_query($conn, $query);
                    if ($result) {
                        header("location:ownerposts.php");
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file." . $errorUpload;
                    }
                }
            } else {
                $statusMsg = 'Please select a file to upload.';
            }
            
        }
        if ($selected === 'bungalow') {
            $nor = $_POST['no_of_room'];
            $nob = $_POST['no_of_bathroom'];
            $nof = $_POST['no_of_floor'];   
            $area = $_POST['area'];
            $locality = $_POST['locality'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $rent = $_POST['rent'];
            $deposit = $_POST['deposit'];
            $more = $_POST['more'];
            $negotiable = $_POST['negotiable'];
            if (!empty($fileNames)) {
                foreach ($_FILES['files']['name'] as $key => $val) {
                    // File upload path 
                    $fileName = rand(10, 10000).basename($_FILES['files']['name'][$key]) ;
                    $targetFilePath = $targetDir . $fileName;
                    echo $targetFilePath."<br>";
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if (in_array($fileType, $allowTypes)) {
                        // Upload file to server 
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                            // Image db insert sql 
                            $insertValuesSQL .= '"'. $fileName . '", ';
                        } else {
                            $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                        }
                    } else {
                        $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                    }
                }
                $insertValuesSQL .= "}";

                $insertValuesSQL = str_replace(", }","}",$insertValuesSQL);
                echo $insertValuesSQL;
                if (!empty($insertValuesSQL)) {
                    // Insert image file name into database
                    $query = "INSERT into bungalow (oid,no_of_room,no_of_bathroom,no_of_floor,area,locality,address,city,rent,deposit,more,balcony,parking,negotiable,images)
                         VALUES ('".$_SESSION["uid"]."','$nor','$nob','$nof','$area','$locality','$address','$city','$rent','$deposit','$more','$negotiable','$insertValuesSQL')";
                    $result = pg_query($conn, $query);
                    if ($result) {
                        $statusMsg = "Files are uploaded successfully.";
                        echo $statusMsg;
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file." . $errorUpload;
                    }
                }
            } else {
                $statusMsg = 'Please select a file to upload.';
            }
        }
    }
    pg_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Upload/pdetails.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Upload</title>
</head>

<body>
    <div class="main">
        <h2>Property Details</h2>
        <form action="" method="post" enctype="multipart/form-data" class="mform" id="myform">
            <div class="input-field-s">
                <b class="h">Property Type</b>
                <select class="butn" name="type" id="select" onchange="newform()">
                    <option selected value="hidden" disabled>Property Type</option>
                    <option value="flat">Flat</option>
                    <option value="rowhouse" reuired>RowHouse</option>
                    <option value="bungalow">Bungalow</option>
                </select>
            </div>
            <div class="input-field" id="bhk">
                <b class="h">BHK type</b>
                <input type="number" name="bhk" placeholder="BHK type">
            </div>
            <div class="input-field" id="n_room">
                <b class="h">Room Count</b>
                <input type="number" name="no_of_room" placeholder="No of rooms">
            </div>
            <div class="input-field" id="n_bathroom">
                <b class="h">No of Bathroom</b>
                <input type="number" name="no_of_bathroom" placeholder="No of bathroom">
            </div>
            <div class="input-field" id="n_floor">
                <b class="h">No of floor</b>
                <input type="number" name="no_of_floor" placeholder="No of floor">
            </div>
            <div class="input-field" id="area">
                <b class="h">Area</b>
                <input type="number" name="area" placeholder="Area(in sqft)">
            </div>
            <div class="input-field" id="floor">
                <b class="h">Floor</b>
                <input type="number" name="floor">
            </div>
            <div class="input-field-b" id="balcony">
                <div class="balcony">
                    <b class="b">Balcony</b>
                    <div class="radi">
                        <label for="yes">Yes</label>
                        <input type="radio" name="balcony" value="yes">
                        <label for="no">No</label>
                        <input type="radio" name="balcony" value="no" checked>

                    </div>
                </div>

                <div class="parking" id="parking">
                    <b class="h">Parking</b>
                    <div class="radi">
                        <label for="yes">Yes</label>
                        <input type="radio" name="parking" value="yes">
                        <label for="no">No</label>
                        <input type="radio" name="parking" value="no" checked>

                    </div>
                </div>
            </div>

            <div class="input-field" id="locality">
                <b class="h">Locality(Area)</b>
                <input type="text" name="locality" placeholder="Area name">
            </div>

            <div class="input-field" id="address">
                <b class="h">Address</b>
                <input type="text" name="address" placeholder="Flat no,Block no,Street">
            </div>
            <div class="input-field" id="city">
                <b class="h">City</b>
                <input type="text" name="city" placeholder="City name">
            </div>

            <div class="input-field-rent" id="rent">
                <div>
                    <b style="padding: 2px;">Rent</b>
                    <input type="number" name="rent" placeholder="Rent" style="border: 2px solid grey; padding-left:10px">
                </div>
                <div class="n">
                    <b class="h">Rent Negotiable?</b>
                    <div style="display: flex; flex-direction:row; padding:5px">
                        <input type="radio" name="negotiable" value="yes">
                        <label for="yes">Yes</label><br>
                        <input type="radio" name="negotiable" value="no" checked>
                        <label for="no">No</label><br>
                    </div>
                </div>
            </div>
            <div class="input-field" id="deposit">
                <b class="h">Deposit</b>
                <input type="number" name="deposit" placeholder="Deposit">
            </div>
            <input id="file-input" name="files[]" type="file" multiple>
            <div id="preview"></div>
            <div class="input-field" id="more">
                <b class="h">Description about Property</b>
                <input type="text" name="more" placeholder="Short description">
            </div>
            <input type="submit" name="Submit" onclick="return validate()" class="submit-butn" id="submit">
        </form>

    </div>
    <script>
        function validate() {
            var bhk = document.getElementsByName("bhk");
            var nor = document.getElementsByName("no_of_room");
            var nob = document.getElementsByName("no_of_bathroom");
            var nof = document.getElementsByName("no_of_floor");
            var area = document.getElementsByName("area");
            var floor = document.getElementsByName("floor");
            var locality = document.getElementsByName("locality");
            var address = document.getElementsByName("address");
            var city = document.getElementsByName("city");
            var rent = document.getElementsByName("rent");
            var deposit = document.getElementsByName("deposit");
            var file = $("#file-input")[0].files.length;
            var more = document.getElementsByName("more");

            var x = document.getElementById("select").value;
            if (x == "flat") {
                if (
                    bhk == "" ||
                    floor == "" ||
                    locality == "" ||
                    address == "" ||
                    city == "" ||
                    rent == "" ||
                    deposit == "" ||
                    file == 0
                ) {
                    alert("One or more attribute is empty");
                    return false;
                }
            } else if (x == "rowhouse") {
                if (
                    nor == "" ||
                    nob == "" ||
                    nof == "" ||
                    area == "" ||
                    locality == "" ||
                    address == "" ||
                    city == "" ||
                    rent == "" ||
                    deposit == "" ||
                    file == 0
                ) {
                    alert("One or more attribute is empty");
                    return false;
                }
            } else if (x == "bungalow") {
                if (
                    nor == "" ||
                    nob == "" ||
                    nof == "" ||
                    area == "" ||
                    locality == "" ||
                    address == "" ||
                    city == "" ||
                    rent == "" ||
                    deposit == "" ||
                    file == 0
                ) {
                    alert("One or more attribute is empty");
                    return false;
                }
            } else return true;
        }

        function previewImages() {
            var preview = document.querySelector("#preview");

            if (this.files) {
                [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {
                // Make sure `file.name` matches our extensions criteria
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                } // else...

                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                });

                reader.readAsDataURL(file);
            }
        }

        document.querySelector("#file-input").addEventListener("change", previewImages);
        document.getElementById("bhk").style.display = "none";
        document.getElementById("n_room").style.display = "none";
        document.getElementById("n_bathroom").style.display = "none";
        document.getElementById("n_floor").style.display = "none";
        document.getElementById("area").style.display = "none";
        document.getElementById("floor").style.display = "none";
        document.getElementById("balcony").style.display = "none";
        document.getElementById("locality").style.display = "none";
        document.getElementById("address").style.display = "none";
        document.getElementById("city").style.display = "none";
        document.getElementById("rent").style.display = "none";
        document.getElementById("deposit").style.display = "none";
        document.getElementById("file-input").style.display = "none";
        document.getElementById("more").style.display = "none";
        document.getElementById("submit").style.display = "none";

        function newform() {
            var x = document.getElementById("select").value;
            if (x == "flat") {
                $('input[type="text"]').val("");
                $('input[type="number"]').val("");
                $('input[type="radio"]').prop("checked", false);
                document.getElementById("bhk").style.display = "";
                document.getElementById("n_room").style.display = "none";
                document.getElementById("n_room").required = "false";
                document.getElementById("n_bathroom").style.display = "none";
                document.getElementById("n_bathroom").required = "false";
                document.getElementById("n_floor").style.display = "none";
                document.getElementById("n_floor").required = "false";
                document.getElementById("area").style.display = "none";
                document.getElementById("area").required = "false";
                document.getElementById("floor").style.display = "";
                document.getElementById("balcony").style.display = "";
                document.getElementById("locality").style.display = "";
                document.getElementById("address").style.display = "";
                document.getElementById("city").style.display = "";
                document.getElementById("rent").style.display = "";
                document.getElementById("deposit").style.display = "";
                document.getElementById("file-input").style.display = "";
                document.getElementById("more").style.display = "";
                document.getElementById("submit").style.display = "";
            } else if (x == "rowhouse") {
                $('input[type="text"]').val("");
                $('input[type="number"]').val("");
                $('input[type="radio"]').prop("checked", false);
                document.getElementById("bhk").style.display = "none";
                document.getElementById("bhk").required = "false";
                document.getElementById("n_room").style.display = "";
                document.getElementById("n_bathroom").style.display = "";
                document.getElementById("n_floor").style.display = "";
                document.getElementById("area").style.display = "";
                document.getElementById("floor").style.display = "none";
                document.getElementById("floor").required = "false";
                document.getElementById("balcony").style.display = "";
                document.getElementById("locality").style.display = "";
                document.getElementById("address").style.display = "";
                document.getElementById("city").style.display = "";
                document.getElementById("rent").style.display = "";
                document.getElementById("deposit").style.display = "";
                document.getElementById("file-input").style.display = "";
                document.getElementById("more").style.display = "";
                document.getElementById("submit").style.display = "";
            } else if (x == "bungalow") {
                $('input[type="text"]').val("");
                $('input[type="number"]').val("");
                $('input[type="radio"]').prop("checked", false);
                document.getElementById("bhk").style.display = "none";
                document.getElementById("bhk").required = "false";
                document.getElementById("n_room").style.display = "";
                document.getElementById("n_bathroom").style.display = "";
                document.getElementById("n_floor").style.display = "";
                document.getElementById("area").style.display = "";
                document.getElementById("floor").style.display = "none";
                document.getElementById("floor").required = "false";
                document.getElementById("balcony").style.display = "none";
                document.getElementById("balcony").required = "false";
                document.getElementById("locality").style.display = "";
                document.getElementById("address").style.display = "";
                document.getElementById("city").style.display = "";
                document.getElementById("rent").style.display = "";
                document.getElementById("deposit").style.display = "";
                document.getElementById("file-input").style.display = "";
                document.getElementById("more").style.display = "";
                document.getElementById("submit").style.display = "";
            }
        }
    </script>
</body>

</html>