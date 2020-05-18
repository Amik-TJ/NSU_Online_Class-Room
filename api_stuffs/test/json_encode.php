<?php
    $post_arr = array(
        'class_id' => "cse_327_6",
        'secret_message' => "Create a Post",
        'created_by' => "s1",
        'token' => 1,
        'priority' => 3,
        'material' => "image.jpg",
        'post_text' => "This is a trial for CREATE POST API"
    );
    echo "<pre>";
    echo json_encode($post_arr);
    echo "</pre>";
?>