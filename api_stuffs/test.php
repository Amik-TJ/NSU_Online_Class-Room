<?php

    $pdo = new PDO('mysql:host=localhost;dbname=nsu_online_classroom',
        'root', '');


    $class_id = 'cse_327_6';
    $post_priority = 3;
    $error_message = "Initially There is no Error";
    $message = false;
    $post_table = "post";
    $person_table = "person";


    $sql = 'SELECT ps.post_id, ps.created_by as creator_id, p.name as creator_name,ps.created_time, ps.post_text, ps.material as post_material FROM ' .$post_table. ' as ps, '.$person_table.' as p WHERE ps.created_by=p.person_id and ps.class_id= :class_id and ps.priority=' .$post_priority;
    echo "<pre>\n";
    echo $sql;
    echo "</pre>\n";

    // Prepare Statement
    if ($stmt = $pdo->prepare($sql)){
        if ($stmt->execute(array(
            ':class_id' => $class_id
        ))) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<pre>\n";
            print_r($row);
            echo "</pre>\n";




        }else{
            $error_message = "error in execute";
            echo $error_message;
        }

    }else{
        $error_message = "There is a Problem in Query";
        echo $error_message;
    }


?>