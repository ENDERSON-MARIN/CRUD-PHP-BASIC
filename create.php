<?php

    include('conection.php');
    include('functions.php');

    /*************************************CREATE***************************************/
    if($_POST["operation_type"] == "Create"){
        $image = '';
        if($_FILES["person_image"]["name"] != ''){
            $image = uploadImage();
        }

        $query = $conection->prepare("INSERT INTO personas(names, surnames, email, phone, image)VALUES(:names, :surnames, :email, :phone, :image)");

        $result = $query->execute(
            array(
                ':names' => $_POST["names"],
                ':surnames' => $_POST["surnames"],
                ':email' => $_POST["email"],
                ':phone' => $_POST["phone"],
                ':image' => $image,
            )
        );

        if(!empty($result)){
            echo "Person create successfully!";
        }
    }

    /*************************************EDIT***************************************/
    if($_POST["operation_type"] == "Edit"){
        $image = '';
        if($_FILES["person_image"]["name"] != ''){
            $image = uploadImage();
        }else{
            $image = $_POST["person_img_hidden"];
        }

        $query = $conection->prepare("UPDATE personas SET names=:names, surnames=:surnames, email=:email, phone=:phone, image=:image WHERE id = :id");

        $result = $query->execute(
            array(
                ':names' => $_POST["names"],
                ':surnames' => $_POST["surnames"],
                ':email' => $_POST["email"],
                ':phone' => $_POST["phone"],
                ':image' => $image,
                ':id' => $_POST["person_id"]
            )
        );

        if(!empty($result)){
            echo "Person update successfully!";
        }
    }