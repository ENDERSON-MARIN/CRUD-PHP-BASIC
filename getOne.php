<?php

    include('conection.php');
    include('functions.php');

    if(isset($_POST["person_id"])){
        $final_result = array();
        $query = $conection->prepare("SELECT * FROM personas WHERE id = '".$_POST["person_id"]."' LIMIT 1");
        $query->execute();
        $results = $query->fetchAll();
        foreach($results as $row){
            $final_result["names"] = $row["names"];
            $final_result["surnames"] = $row["surnames"];
            $final_result["email"] = $row["email"];
            $final_result["phone"] = $row["phone"];
            if($row["image"] != ''){
                $final_result["person_image"] = '<img src="img/' . $row["image"] . '" class="img-thumbnail" width="200" heigth="100" /><input type="hidden" name="person_img_hidden" value="'.$row["image"].'" />';
            }else{
                $final_result["person_image"] = '<input type="hidden" name="person_img_hidden" value="" />';
            }
        }

        echo json_encode($final_result);
    }



