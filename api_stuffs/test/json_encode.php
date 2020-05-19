<?php
//    $post_arr = array(
//        'class_id' => "cse_327_6",
//        'secret_message' => "Create a Post",
//        'created_by' => "s1",
//        'token' => 1,
//        'priority' => 3,
//        'material' => "image.jpg",
//        'post_text' => "This is a trial for CREATE POST API",
//        'assignment_title' => "Assignment 3",
//        'assignment_due_date' => "2020-05-20T13:00"
//
//    );
//    echo "<pre>";
//    echo json_encode($post_arr);
//    echo "</pre>";

    echo "<br>";

    $post_arr = array(
        'post_id' => "cse_225_10_4",
        'secret_message' => "Create a Comment",
        'commiter_id' => "s1",
        'comments' => "This is a trial Comment for CREATE Comment API"
    );
    echo "<pre>";
    echo json_encode($post_arr);
    echo "</pre>";
?>