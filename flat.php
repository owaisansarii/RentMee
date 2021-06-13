<?php
    session_start(); /* Starts the session */
    include("data.php");
    $id = $_GET['id'];
    $query = 'Select * from flat where id='.$id ;
    $result = pg_query($conn, $query);
    function pg_array_parse($literal){
        if ($literal == '') return;
        preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $literal, $matches, PREG_SET_ORDER);
        $values = [];
        foreach ($matches as $match) {
            $values[] = $match[3] != '' ? stripcslashes($match[3]) : (strtolower($match[2]) == 'null' ? null : $match[2]);
        }
        return $values;
    }
    $imgpath = "Upload/images/" . $_SESSION['uid'] . "/flat"."/";
    $output ='<?php $id='.$id.'?>';
    while ($row = pg_fetch_assoc($result)) {
        $images = pg_array_parse($row['images']);
        $n = sizeof($images);
        $output .= '<div class="con">
        <input type="hidden" id="ptype" value="flat">
            <div class="feature">

            <img id="featured" src="' . $imgpath . $images[0] . '">
            </div>
            <div id="slide-wrapper">
                <img id="slideLeft" class="arrow" src="img/arrow-circle-left.svg">
                <div id="slider">
                    <img class="thumbnail active" src="' . $imgpath . $images[0] . '">';
        for ($i = 1; $i < $n; $i++)
            $output .=  '<img class="thumbnail" src="' . $imgpath . $images[$i] . '">';
        $output .= '</div>
                <img id="slideRight" class="arrow" src="img/arrow-circle-right.svg">
            </div>
        </div>
        <div class="table-responsive">  
        <table class="table table-bordered">
            <tr>  
                <td width="30%"><label>BHK</label></td>  
                <td width="70%">' . $row["bhk"] . '</td>  
            </tr>  
            <tr>  
                <td width="30%"><label>Floor</label></td>  
                <td width="70%">' . $row["floor"] . '</td>  
            </tr>  
            <tr>  
                <td width="30%"><label>Loaclity</label></td>  
                <td width="70%">' . $row["locality"] . '</td>  
            </tr>  
            <tr>  
                <td width="30%"><label>Address</label></td>  
                <td width="70%">' . $row["address"] . '</td>  
            </tr>  
            <tr>  
                <td width="30%"><label>City</label></td>  
                <td width="70%">' . $row["city"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>Rent</label></td>  
                <td width="70%">' . $row["rent"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>Deposit</label></td>  
                <td width="70%">' . $row["deposit"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>More</label></td>  
                <td width="70%">' . $row["more"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>Balcony</label></td>  
                <td width="70%">' . $row["balcony"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>Parking</label></td>  
                <td width="70%">' . $row["parking"] . '</td>  
            </tr> 
            <tr>  
                <td width="30%"><label>Availablity</label></td>  
                <td width="70%">' . $row["status"] . '</td>  
            </tr> 
            </table></div> 
            ';
    }
    echo $output;
?>