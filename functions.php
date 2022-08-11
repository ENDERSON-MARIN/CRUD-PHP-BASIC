<?php

    function uploadImage(){
        if(isset($_FILES["person_image"])){
            $img_extension = explode('.', $_FILES["person_image"]['name']);
            $img_name = rand() . '.' . $img_extension[1];
            $img_folder = './img/' . $img_name;
            move_uploaded_file($_FILES["person_image"]['tmp_name'], $img_folder);
            return $img_name;
        }
    }

    function getImgName($person_id){
        include('conection.php');
        $query = $conection->prepare("SELECT image FROM personas WHERE id = '$person_id'");
        $query->execute();
        $result = $query->fetchAll();
        foreach($result as $row){
            return $row["image"];
        }
    }

    function getAllData(){
        include('conection.php');
        $query = $conection->prepare("SELECT * FROM personas ");
        $query->execute();
        $result = $query->fetchAll();
        return $query->rowCount();
    }