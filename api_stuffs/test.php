<?php

    $pdo = new PDO('mysql:host=localhost;dbname=nsu_online_classroom',
        'root', '');


    $class_id = 'cse_327_6';
    $post_priority = 3;
    $error_message = "Initially There is no Error";
    $message = false;
    $post_table = "post";
    $person_table = "person";
    $post_id = "cse_327_6_2";
    $comments_table = "comments";
    $comments_arr = array(
        'success' => 0,
        'error_message' => "There is no Comments for this Post"
    );


    /*$sql = 'SELECT c.post_id, c.commiter_id, p.name as commiter_name, c.comments FROM comments as c, person as p WHERE c.commiter_id=p.person_id and c.post_id = ;post_id ';
    echo "<pre>\n";
    echo $sql;
    echo "</pre>\n";*/


    $query = 'SELECT c.post_id, c.commiter_id, p.name as commiter_name, c.comments FROM '.$comments_table.' as c, person as p WHERE c.commiter_id=p.person_id and c.post_id = "'.$post_id.'"';
    if($stmt = $pdo->query($query)){
        $num = $stmt->rowCount();
        if( $num > 0 ){
            $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
            $comments_arr = array(
                'success' => 1,
                'data' => $rows
            );


            echo "<pre>\n";
            print_r($comments_arr);
            echo "</pre>\n";
            /*echo $num;*/
        }else{
            echo "<pre>\n";
            print_r($comments_arr);
            echo "</pre>\n";
        }
    }else{
        $comments_arr['error_message'] = "There is a problem on Comments Query";
    }




   /* // Prepare Statement
    if ($stmt = $pdo->prepare($sql)){
        if ($stmt->execute(array(
            ':post_id' => $post_id
        ))) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

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
    }*/


?>