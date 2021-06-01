<?php
    $id=14;
    mkdir("Upload/images/$id");
    // $host="localhost";
    // $user="postgres";
    // $pass="owais";
    // $db="rentmgmtsys";
    // $conn=pg_connect("host=$host dbname=$db user=$user password=$pass")
    //     or die("could not connect to the server!");

    // $query='Select * from flat where oid=14';
    // $result=pg_query($conn,$query);
    // $row = pg_fetch_assoc($result);
    // function pg_array_parse($literal){
    // if ($literal == '') return;
    // preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER);
    // $values = [];
    // foreach ($matches as $match) {
    //     $values[] = $match[3] != '' ? stripcslashes($match[3]) : (strtolower($match[2]) == 'null' ? null : $match[2]);
    // }
    // return $values;
    // }
    // $images=pg_array_parse($row['images']);
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $n=sizeof($images);
        for($i=0;$i<$n;$i++){
            echo "<img src='Upload/images/$images[$i]' alt=''>";
        }
    ?>
    
</body>
</html> -->