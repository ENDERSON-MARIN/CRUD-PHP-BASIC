<?php

    include('conection.php');
    include('functions.php');

    $query = "";
    $final_result = array();
    $query = "SELECT * FROM personas ";

    if(isset($_POST["search"]["value"])){
        $query .= 'WHERE names LIKE "%' . $_POST["search"]["value"] . '%" ';
        $query .= 'OR surnames LIKE "%' . $_POST["search"]["value"] . '%" ';
    }

    if(isset($_POST["order"])){
        $query .= 'ORDER BY ' . $_POST['order']['0']['column'] .' '. $_POST["order"][0]['dir'] . ' ';
    }else{
        $query .= 'ORDER BY id DESC ';
    }

    if($_POST["length"] != -1){
        $query .= 'LIMIT ' . $_POST["start"] . ','. $_POST["length"];
    }

    $response = $conection->prepare($query);
    $response->execute();
    $results = $response->fetchAll();
    $all_data = array();
    $filtered_rows = $response->rowCount();
    foreach($results as $row){
        $img = '';
        if($row["image"] != ""){
            $img = '<img src="img/' . $row["image"] . '" class="img-thumbnail" width="60" heigth="10" />';
        }else{
            $img = '';
        }

        $sub_array = array();
        $sub_array[] = $row["id"];
        $sub_array[] = $row["names"];
        $sub_array[] = $row["surnames"];
        $sub_array[] = $row["email"];
        $sub_array[] = $row["phone"];
        $sub_array[] = $img;
        $sub_array[] = $row["created_date"];
        $sub_array[] = '<button type="button" name="edit" id="'.$row["id"].'" class="btn btn-warning btn-xs edit"> Edit </button> ';
        $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete"> Delete </button> ';

        $all_data[] = $sub_array;
    }

    $final_result = array(
        "draw"            =>intval($_POST["draw"]),
        "recordsTotal"    =>$filtered_rows,
        "recordsFiltered" => getAllData(),
        "data"            => $all_data
    );

    echo json_encode($final_result);

    

