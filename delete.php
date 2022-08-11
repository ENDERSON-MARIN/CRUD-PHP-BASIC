<?php

    include('conection.php');
    include('functions.php');

    /*************************************DELETE***************************************/
    if( isset($_POST["person_id"])){
        $image_name = getImgName($_POST["person_id"]);

        if($image_name != ''){
            unlink("img/" .$image_name);
        }

        $query = $conection->prepare("DELETE FROM personas WHERE id = :id");

        $result = $query->execute(
            array(
                ':id' => $_POST["person_id"]
            )
        );

        if(!empty($result)){
            echo "Person delete successfully!";
        }
    }